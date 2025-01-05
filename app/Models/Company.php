<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'province',
        'city',
        'subdistrict',
        'status',
        'logo',
        'bank',
        'norek'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
