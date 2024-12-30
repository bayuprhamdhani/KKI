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
            $cars = Car::all();
        } else {
            // Jika role_id bukan 1, filter berdasarkan company-name
            $cars = Car::where('company_name', $user->name)->get();
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
            'pict' => 'required',
            'status' => 'required',
            'company' => 'required',
        ]);
        // dd($data);
        if ($request->file('pict')) {
            $validatedData['pict'] = $request->file('pict')->store('car-pict', 'public');
        }

        $check = Car::create([
            'name' => $validatedData['name'],
            'qty' => $validatedData['qty'],
            'transmisi' =>$validatedData['transmisi'],
            'price' =>$validatedData['price'],
            'pict' =>$validatedData['pict'],
            'status' =>$validatedData['status'],
            'company' =>$validatedData['company']
        ]);
         
        return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully created');
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
        $validatedData['pict'] = $request->file('pict')->store('car-pict', 'public');
        // Hapus Gambar Lama (Opsional)
        if ($car->pict) {
            \Storage::disk('public')->delete($car->pict);
        }
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
