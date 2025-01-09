<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sizes'; // Specify the table name if it's not pluralized

    protected $fillable = [
        'size',
    ];

    // Define the relationship with the Tshirt model
    public function tshirts()
    {
        return $this->hasMany(Tshirt::class);
    }

    // Define the relationship with the TshirtStock model
    public function tshirtStocks()
    {
        return $this->hasMany(TshirtStock::class);
    }

    // Define the relationship with the TshirtSale model
    public function tshirtSales()
    {
        return $this->hasMany(TshirtSale::class);
    }
}
