<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'qty',
        'transmisi',
        'price',
        'pict',
        'status',
        'company'
    ];

// app/Models/Car.php
public function company() {
    return $this->belongsTo(Company::class, 'company', 'id');  // 'company' adalah foreign key di tabel cars
}
// app/Models/Car.php
public function transactions()
{
    return $this->hasMany(Transaction::class, 'car', 'id');
}

}
