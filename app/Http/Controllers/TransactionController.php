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
         // Ambil user yang sedang login
         $user = Auth::user();
     
         if ($user->role_id == 1) {
            // Jika role_id == 1, ambil semua data cars yang id-nya ada di tabel transactions
            $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
                ->join('transactions', 'transactions.car', '=', 'cars.id')
                ->select(
                    'cars.id', 'cars.name as car_name', 'cars.pict', 
                    'companies.logo', 'companies.name as company',
                    'transactions.pick_up', 'transactions.drop_off', 'transactions.date_order', 'transactions.price'
                )
                ->get();
    
            // Kirim data ke view
            return view('transactions.index', compact('cars'));
        } elseif ($user->role_id == 2) {
            $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
            ->join('transactions', 'transactions.car', '=', 'cars.id')
            ->select(
                'cars.id', 'cars.name as car_name', 'cars.pict', 'cars.company', 
                'companies.logo', 'companies.name as company',
                'transactions.pick_up', 'transactions.drop_off', 'transactions.date_order', 'transactions.price'
            )
            ->where('cars.company', $user->user)
            ->get();
        } elseif ($user->role_id == 3){
            $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
            ->join('transactions', 'transactions.car', '=', 'cars.id')
            ->select(
                'cars.id', 'cars.name as car_name', 'cars.pict', 
                'companies.logo', 'companies.name as company',
                'transactions.pick_up', 'transactions.drop_off', 'transactions.date_order', 'transactions.price'
            )
            ->where('transactions.customer', $user->user)
            ->get();
        }
     
         // Ambil data status dan transmisi
         $statuses = Status::all();
         $transmisies = Transmisi::all();
         $transactions = Transaction::all();
     
         // Kirim data ke view
         return view('transactions.index', compact('cars', 'transmisies', 'statuses', 'transactions'));
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
         
        return redirect()->route('transactions.index')
        ->withSuccess('Great! You have successfully created');
    }

}
