<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Car;
use App\Models\Payment;
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
        $payments = Payment::all();
    
        // Ambil tanggal pick-up dan drop-off dari query string
        $pick_up = $request->input('pick_up');
        $drop_off = $request->input('drop_off');
        
        return view('transactions.create', compact('countries', 'provinces', 'cities', 'subdistricts', 'card_types', 'car', 'pick_up', 'drop_off', 'payments'));
    }
    
    public function registration2(Request $request)
    {
        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();
        $car = Car::findOrFail($request->id); // Ambil ID dari query string
        $subdistricts = Subdistrict::all();
        $card_types = CardType::all();
        $user = Auth::user();
        $payments = Payment::all();
    
        // Ambil tanggal pick-up dan drop-off dari query string
        $pick_up = $request->input('pick_up');
        $drop_off = $request->input('drop_off');
        
        return view('transactions.create2', compact('countries', 'provinces', 'cities', 'subdistricts', 'card_types', 'car', 'pick_up', 'drop_off', 'payments'));
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
        'password' => 'required|min:6|confirmed',

        //tabel transactions
        'car' => 'required',
        'pick_up' => 'required',
        'drop_off' => 'required',
        'date_order' => 'required',
        'price' => 'required',
        'payment' => 'required',

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
        'cvv' => ['required', 'numeric', 'digits:4'],
    ]);

    DB::beginTransaction(); // Mulai Transaction

    try {
        // Simpan ke Tabel Customer
        $customer = Customer::create([
            'name' => $validatedData['customer'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Gunakan password dari User
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

        // Simpan ke Tabel User
        $user = User::create([
            'user' => $customer->id,
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3, // Set role ke "customer"
            'path' => "",
        ]);

        // Simpan ke Tabel Transaction dengan customer_id dari tabel customer
        Transaction::create([
            'customer' => $customer->id,  // Gunakan id customer yang baru saja dibuat
            'car' => $validatedData['car'],
            'pick_up' => $validatedData['pick_up'],
            'drop_off' => $validatedData['drop_off'],
            'date_order' => $validatedData['date_order'],
            'price' => $validatedData['price'],
            'payment' => $validatedData['payment']
        ]);

        DB::commit(); // Commit Transaction

        return redirect('login')->with('success', 'Great! You have Successfully registered');
    } catch (\Throwable $e) {
        DB::rollBack();
        dd($e->getMessage()); // Debug langsung
    }
}

public function postRegistration2(Request $request): RedirectResponse
{
    // Validasi Input
    $validatedData = $request->validate([

        //tabel transactions
        'car' => 'required',
        'pick_up' => 'required',
        'drop_off' => 'required',
        'date_order' => 'required',
        'price' => 'required',
        'customer' => 'required',
        'payment' => 'required'
    ]);

    DB::beginTransaction(); // Mulai Transaction

    try {
        // Simpan ke Tabel Transaction dengan customer_id dari tabel customer
        Transaction::create([
            'customer' => $validatedData['customer'],  // Gunakan id customer yang baru saja dibuat
            'car' => $validatedData['car'],
            'pick_up' => $validatedData['pick_up'],
            'drop_off' => $validatedData['drop_off'],
            'date_order' => $validatedData['date_order'],
            'price' => $validatedData['price'],
            'payment' => $validatedData['payment']
        ]);

        DB::commit(); // Commit Transaction

        return redirect('transactions')->with('success', 'Great! You have Successfully registered');
    } catch (\Throwable $e) {
        DB::rollBack();
        dd($e->getMessage()); // Debug langsung
    }
}

public function uploadPayment(Request $request, $transaction_id)
{
    // Validasi input
    $validatedData = $request->validate([
        'payment_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Ambil transaksi berdasarkan ID transaksi
    $transaction = \App\Models\Transaction::findOrFail($transaction_id);

    // Simpan file dan buat nama file sesuai ID transaksi
    if ($request->file('payment_photo')) {
        $file = $request->file('payment_photo');
        $fileName = $transaction->id . '.' . $file->getClientOriginalExtension();  // Buat nama file sesuai ID
        $path = $file->storeAs('payment-pict', $fileName, 'public');  // Simpan dengan nama baru
    }

    // Update kolom pictPayment di tabel transactions
    $transaction->update([
        'pictPayment' => $path
    ]);

    return redirect()->back()->with('success', 'Payment photo uploaded successfully!');
}



}
