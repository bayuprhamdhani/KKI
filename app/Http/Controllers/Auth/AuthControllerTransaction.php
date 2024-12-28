<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Car;
use App\Models\Transaction;
use App\Models\Subdistrict;
use App\Models\CardType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthControllerTransaction extends Controller
{
    /**
     * Tampilkan halaman registrasi customer.
     */
    public function registration(Request $request)
    {
        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();
        $car = Car::findOrFail($request->id); // Ambil ID dari query string
        $subdistricts = Subdistrict::all();
        $card_types = CardType::all();
    
        return view('transactions.create', compact('countries', 'provinces', 'cities', 'subdistricts', 'card_types', 'car'));
    }

    /**
     * Proses registrasi customer.
     */
    public function postRegistration(Request $request): RedirectResponse
    {
        // Validasi Input
        $validatedData = $request->validate([

            //tabel users
            'email' => 'required|email|unique:users|unique:customers',
            'password' => 'required|min:6',

            //tabel transactions
            'company' => 'required',
            'car' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required',
            'date_order' => 'required',
            'price' => 'required',

            //tabel customer
            'customer' => 'required',
            'contact' => ['required', 'numeric'],
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'card_type' => 'required',
            'card_number' => ['required', 'numeric'],
            'card_expired' => 'required',
            'cvv' => ['required', 'numeric', 'digits:3'],
        ]);

        DB::beginTransaction(); // Mulai Transaction

        try {
            // Simpan ke Tabel User
            $user = User::create([
                'name' => $validatedData['customer'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 3, // Set role ke "customer"
                'path' => "",
            ]);

            // Simpan ke Tabel Customer
            Transaction::create([
                'customer' => $validatedData['customer'],
                'company' => $validatedData['company'],
                'car' =>$validatedData['car'],
                'pick_up' =>$validatedData['pick_up'],
                'drop_off' =>$validatedData['drop_off'],
                'date_order' =>$validatedData['date_order'],
                'price' =>$validatedData['price']
            ]);

            Customer::create([
                'name' => $validatedData['customer'],
                'email' => $validatedData['email'],
                'password' => $user->password, // Gunakan password dari User
                'contact' => $validatedData['contact'],
                'country' => $validatedData['country'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'subdistrict' => $validatedData['subdistrict'],
                'card_type' => $validatedData['card_type'],
                'card_number' => $validatedData['card_number'],
                'card_expired' => $validatedData['card_expired'],
                'cvv' => $validatedData['cvv'],
            ]);

            DB::commit(); // Commit Transaction

            return redirect('dashboard')->with('success', 'Great! You have Successfully registered');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage()); // Debug langsung
        }
        
    }
}
