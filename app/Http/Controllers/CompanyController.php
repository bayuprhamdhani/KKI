<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies',
            'password' => 'required|min:6',
            'address' => 'required',
            'logo' => 'required',
            'bank' => 'required',
            'norek' => 'required'
        ]);
           
        $data = $request->all();
        // dd($data);
        $check = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' =>$data['address'],
            'logo' =>$data['logo'],
            'bank' =>$data['bank'],
            'norek' =>$data['norek']
        ]);
         
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
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'address' => 'required',
            'logo' => 'required',
            'bank' => 'required',
            'norek' => 'required'
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        if(!empty($request->password)) $company->password = Hash::make($request->password);
        $company->address = $request->address;
        $company->logo = $request->logo;
        $company->bank = $request->bank;
        $company->norek = $request->norek;
        $company->save();

        return redirect()->route('companies.index')
        ->withSuccess('Great! You have successfully updated '.$company->name);
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
