<?php

namespace App\Http\Controllers;

use App\Models\Transmisi;
use App\Models\Status;
use App\Models\Car;
use App\Models\Transaction;
use App\Models\CardType;
use App\Exports\CarsExport;
use App\Imports\CarsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('transactions.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $card_types = CardType::All();
        return view('transactions.create', compact('card_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer' => 'required',
            'company' => 'required',
            'car' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required',
            'date_order' => 'required',
            'price' => 'required',
        ]);

        $check = Transaction::create([
            'customer' => $validatedData['customer'],
            'company' => $validatedData['company'],
            'car' =>$validatedData['car'],
            'pick_up' =>$validatedData['pick_up'],
            'drop_off' =>$validatedData['drop_off'],
            'date_order' =>$validatedData['date_order'],
            'price' =>$validatedData['price']
        ]);
         
        return redirect()->route('dashboard')
        ->withSuccess('Great! You have successfully created');
    }

}
