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

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $statuses = Status::all();
        $transmisies = Transmisi::all();
        return view('cars.index', compact('cars','transmisies','statuses'));
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
        $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'transmisi' => 'required',
            'mileage' => 'required',
            'price' => 'required',
            'pict' => 'required',
            'status' => 'required'
        ]);
        // dd($data);
        $data = $request->all();

        $check = Car::create([
            'name' => $data['name'],
            'qty' => $data['qty'],
            'transmisi' =>$data['transmisi'],
            'mileage' =>$data['mileage'],
            'price' =>$data['price'],
            'pict' =>$data['pict'],
            'status' =>$data['status'],
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
        $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'transmisi' => 'required',
            'mileage' => 'required',
            'price' => 'required',
            'pict' => 'required',
            'status' => 'required'
        ]);

        $car->name = $request->name;
        $car->qty = $request->qty;
        $car->transmisi = $request->transmisi;
        $car->mileage = $request->mileage;
        $car->price = $request->price;
        $car->pict = $request->pict;
        $car->status = $request->status;
        $car->save();

        return redirect()->route('cars.index')
        ->withSuccess('Great! You have successfully updated '.$car->name);
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
