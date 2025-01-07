<?php

namespace App\Http\Controllers;

use App\Models\Transmisi;
use App\Models\Status;
use App\Models\Car;
use App\Exports\CarsExport;
use App\Imports\CarsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
    
        // Jika role_id == 1, ambil semua data cars
        if ($user->role_id == 1) {
            $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
            ->select('cars.*', 'companies.city', 'companies.name as company_name', 'companies.logo as company_logo')
            ->get();
        } else {
            // Jika role_id bukan 1, filter berdasarkan company-name
            $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
            ->select('cars.*', 'companies.city', 'companies.name as company_name', 'companies.logo as company_logo')
            ->where('companies.id', $user->user)
            ->get();
        
        }
        
    
        // Ambil data status dan transmisi
        $statuses = Status::all();
        $transmisies = Transmisi::all();
    
        // Kirim data ke view
        return view('cars.index', compact('cars', 'transmisies', 'statuses'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        $statuses = Status::all();
        $transmisies = Transmisi::all();
        return view('cars.create', compact('cars','transmisies','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'qty' => 'required',
        'transmisi' => 'required',
        'price' => 'required',
        'pict' => 'required|image|file|max:1024',
        'status' => 'required',
        'company' => 'required',
    ]);

    // Proses penyimpanan file gambar
    if ($request->file('pict')) {
        // Ambil file dan simpan dengan nama menggunakan ID sementara
        $file = $request->file('pict');
        $fileExtension = $file->getClientOriginalExtension();
        // Simpan sementara dengan ID mobil (belum ada ID saat pembuatan)
        $fileName = 'temp_' . uniqid() . '.' . $fileExtension;
        $filePath = $file->storeAs('car-pict', $fileName, 'public');
    }

    // Simpan data mobil
    $car = Car::create([
        'name' => $validatedData['name'],
        'qty' => $validatedData['qty'],
        'transmisi' => $validatedData['transmisi'],
        'price' => $validatedData['price'],
        'status' => $validatedData['status'],
        'company' => $validatedData['company'],
        'pict' => $filePath, // Menyimpan path gambar sementara
    ]);

    // Rename file setelah mobil disimpan
    $newFileName = $car->id . '.' . $fileExtension;
    $newFilePath = 'car-pict/' . $newFileName;

    // Rename file di storage
    \Storage::disk('public')->move($filePath, $newFilePath);

    // Update gambar dengan nama baru
    $car->update(['pict' => $newFilePath]);

    return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully created a car.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statuses = Status::all();
        $transmisies = Transmisi::all();
        $car = Car::find($id);
        return view('cars.edit', compact('car','statuses','transmisies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
{
    // Validasi Input
    $validatedData = $request->validate([
        'name' => 'required',
        'qty' => 'required',
        'transmisi' => 'required',
        'price' => 'required',
        'status' => 'required'
    ]);

    // Jika Ada File Gambar yang Diunggah
    if ($request->file('pict')) {
        // Simpan File Baru
        $file = $request->file('pict');
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = $car->id . '.' . $fileExtension;
        $newFilePath = 'car-pict/' . $newFileName;

        // Hapus Gambar Lama (Opsional)
        if ($car->pict) {
            \Storage::disk('public')->delete($car->pict);
        }

        // Simpan file baru dengan nama ID mobil
        $file->storeAs('car-pict', $newFileName, 'public');

        $validatedData['pict'] = $newFilePath;
    } else {
        // Jika Tidak Ada Gambar Baru, Gunakan Gambar Lama
        $validatedData['pict'] = $car->pict;
    }

    // Update Data Car
    $car->update([
        'name' => $validatedData['name'],
        'qty' => $validatedData['qty'],
        'transmisi' => $validatedData['transmisi'],
        'price' => $validatedData['price'],
        'pict' => $validatedData['pict'],
        'status' => $validatedData['status']
    ]);

    // Redirect dengan Pesan Sukses
    return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully updated ' . $car->name);
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully deleted '.$car->name);
    }

    public function export() 
    {
        return Excel::download(new CarsExport, 'cars.xlsx');
    }

    public function import() 
    {
        Excel::import(new CarsImport,request()->file('file'));
               
        return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully imported ');
    }
}
