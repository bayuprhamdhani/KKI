<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer',
        'company',
        'car',
        'pick_up',
        'drop_off',
        'date_order',
        'price'
    ];
    // app/Models/Transaction.php
public function car()
{
    return $this->belongsTo(Car::class, 'car', 'id');
}

}