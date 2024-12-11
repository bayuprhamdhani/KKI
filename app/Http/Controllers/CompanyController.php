<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Company;
use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        $companies = Company::all();
        return view('companies.index', compact('companies','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();

        return view('companies.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi Input
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:companies',
        'password' => 'required|min:6',
        'address' => 'required',
        'status' => 'required',
        'logo' => 'required|image|file|max:1024',
        'bank' => 'required',
        'norek' => 'required'
    ]);

    // Menyimpan File Logo
    if ($request->file('logo')) {
        $validatedData['logo'] = $request->file('logo')->store('company-logo', 'public');
    }

    // Buat Data ke Database
    $check = Company::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'address' => $validatedData['address'],
        'status' =>$validatedData['status'],
        'logo' => $validatedData['logo'],
        'bank' => $validatedData['bank'],
        'norek' => $validatedData['norek']
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('companies.index')
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
        $company = Company::find($id);
        return view('companies.edit', compact('company','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
{
    // Validasi Input
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'status' => 'required',
        'logo' => 'required',
        'bank' => 'required',
        'norek' => 'required'
    ]);

    // Jika Ada File Gambar yang Diunggah
    if ($request->file('logo')) {
        // Simpan File Baru
        $validatedData['logo'] = $request->file('logo')->store('company-logo', 'public');
        // Hapus Gambar Lama (Opsional)
        if ($company->logo) {
            \Storage::disk('public')->delete($company->logo);
        }
    } else {
        // Jika Tidak Ada Gambar Baru, Gunakan Gambar Lama
        $validatedData['logo'] = $company->logo;
    }
    

    // Update Data Car
    $company->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'address' => $validatedData['address'],
        'status' =>$validatedData['status'],
        'logo' => $validatedData['logo'],
        'bank' => $validatedData['bank'],
        'norek' => $validatedData['norek']
    ]);

    // Redirect dengan Pesan Sukses
    return redirect()->route('companies.index')
        ->withSuccess('Great! You have successfully updated ' . $company->name);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')
        ->withSuccess('Great! You have successfully deleted '.$company->name);
    }

    public function export() 
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }

    public function import() 
    {
        Excel::import(new CompaniesImport,request()->file('file'));
               
        return redirect()->route('companies.index')
        ->withSuccess('Great! You have successfully imported ');
    }
}
