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
        'company'  // Kolom company (ID perusahaan)
    ];

    // Relasi ke Company
    public function company() {
        return $this->belongsTo(Company::class, 'company', 'id');
    }

    // Relasi ke Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'car', 'id');
    }

    // Akses Nama Perusahaan Langsung (Tanpa Relasi)
    public function getCompanyNameAttribute()
    {
        return $this->company()->first()->name ?? 'N/A';
    }
}
