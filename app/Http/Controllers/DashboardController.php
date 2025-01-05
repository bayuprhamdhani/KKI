<?php

namespace App\Http\Controllers;
use App\Charts\TransactionsByCarChart;
use App\Charts\TransactionsByMonthChart;
use App\Charts\TransactionsByCompanyChart;
use App\Charts\TransactionsByCustomerChart;
use App\Models\User;
use App\Models\Subdistrict;
use App\Models\Service;
use App\Models\Chart;
use App\Models\City;
use App\Models\Car;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Province;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function filterCars(Request $request)
    {
        $city = $request->input('city');
        $pick_up = $request->input('pick_up');
        $drop_off = $request->input('drop_off');
        $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
                   ->where('companies.city', $city)
                   ->where('cars.status', '!=', 2) // Filter status
                   ->where('companies.status', '!=', 2); // Filter status
        
    
        if ($pick_up && $drop_off) {
            $cars = $cars->whereDoesntHave('transactions', function ($query) use ($pick_up, $drop_off) {
                $query->where(function ($subQuery) use ($pick_up, $drop_off) {
                    $subQuery->whereBetween('pick_up', [$pick_up, $drop_off])
                             ->orWhereBetween('drop_off', [$pick_up, $drop_off])
                             ->orWhere(function ($subSubQuery) use ($pick_up, $drop_off) {
                                 $subSubQuery->where('pick_up', '<', $pick_up)
                                             ->where('drop_off', '>', $drop_off);
                             });
                });
            });
        }
    
        $cars = $cars->select('cars.*', 'companies.city', 'companies.name as company', 'companies.logo')->get();
    
        $html = '';
        if ($cars->isEmpty()) {
            $html = '<div class="col-12 text-center py-5">
                        <h4>No cars available for this city and date range.</h4>
                     </div>';
        } else {
            foreach ($cars as $car) {
                $transmisiText = $car->transmisi == 1 ? 'Manual' : ($car->transmisi == 2 ? 'Matic' : 'Error');
                
                // Cek apakah user guest atau terautentikasi
                $orderRoute = auth()->check() 
                    ? route('registerTransaction2', ['id' => $car->id, 'pick_up' => $pick_up, 'drop_off' => $drop_off]) 
                    : route('registerTransaction', ['id' => $car->id, 'pick_up' => $pick_up, 'drop_off' => $drop_off]);
                
                $html .= '
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="' . asset('storage/' . $car->pict) . '" alt="' . $car->name . '" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-bold">' . $car->name . '</h5>
                                <h5 class="card-title fw-bold">' . number_format($car->price, 0, ',', '.') . '</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text text-muted">Transmisi : ' . $transmisiText . '</p>
                                <p class="card-text text-muted">Chair : ' . $car->qty . '</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img src="' . asset('storage/' . $car->logo) . '" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                                    <h5 class="card-title fw-bold mt-1">' . $car->company . '</h5>
                                </div>
                                <div>
                                    <a href="' . $orderRoute . '" class="btn btn-sm btn-warning mb-1">ORDER</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    
        return response()->json(['html' => $html]);
    }
    
    


    /**
     * Display a listing of the resource.
     */
    public function index(TransactionsByCarChart $carChart, TransactionsByMonthChart $carChart2, TransactionsByCompanyChart $carChart3, TransactionsByCustomerChart $carChart4)
    {
        $cities = City::all();
        $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
           ->select('cars.*', 'companies.city', 'companies.name as company', 'companies.logo')
           ->get();
        $provinces = Province::all();
        $countries = Country::all();
        $subdistricts = Subdistrict::all();
        $services = Service::all();
        $charts = Chart::all();
        if (auth()->check() && auth()->user()->role_id == 2) {
            // Jika user sudah login dan role_id = 2, ambil dua data pertama
            $charts = $charts->take(2);
        }
        $carTotal = 0;
        if (auth()->check()) {
            $user = auth()->user();
        
            if ($user->role_id == 1) {
                // Jika role_id = 1, hitung semua data di tabel cars
                $carTotal = Car::count();
            } elseif ($user->role_id == 2) {
                // Jika role_id = 2, hitung data dengan kolom company yang sesuai dengan user yang login
                $carTotal = Car::where('company', $user->user)->count();
            }
        }
        
        $companyTotal = Company::count();
        $customerTotal = Customer::count();
        $transactionTotal = 0; // Default collection kosong

        if (auth()->check()) {
            $user = auth()->user();
        
            if ($user->role_id == 1) {
                // Jika role_id = 1, ambil semua transaksi
                $transactionTotal = Transaction::count();
            } elseif ($user->role_id == 2)  {
                // Jika role_id = 2, ambil transaksi yang sesuai dengan company pengguna yang login
                $transactionTotal = Transaction::whereHas('car', function ($query) use ($user) {
                    $query->where('company', $user->user);
                })->count();
            }
        } 

        $user = User::count();
    
        return view('dashboard', compact('carTotal', 'cars', 'user', 'services', 'charts', 'cities', 'provinces', 'countries', 'subdistricts', 'companyTotal', 'customerTotal', 'transactionTotal'))
            ->with(['chart' => $carChart->build(), 'chart2' => $carChart2->build(), 'chart3' => $carChart3->build(), 'chart4' => $carChart4->build()]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
