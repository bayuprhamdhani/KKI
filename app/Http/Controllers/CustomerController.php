<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Ambil user yang sedang login
    $customers = Customer::all();
        // Kirim data ke view
        return view('customers.index',compact('customers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('customers.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        // dd($data);

        $check = Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' =>$validatedData['password'],
        ]);
         
        return redirect()->route('customers.index')
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
        $customer = Customer::find($id);
        return view('customers.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
{
    // Validasi Input
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
    ]);

    // Update Data Car
    $customer->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' =>$validatedData['password'],
    ]);

    // Redirect dengan Pesan Sukses
    return redirect()->route('customers.index')
        ->withSuccess('Great! You have successfully updated ' . $customer->name);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
        ->withSuccess('Great! You have successfully deleted '.$customer->name);
    }

    public function export() 
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function import() 
    {
        Excel::import(new CustomersImport,request()->file('file'));
               
        return redirect()->route('customers.index')
        ->withSuccess('Great! You have successfully imported ');
    }
}
