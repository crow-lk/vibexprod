<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tshirt extends Model
{
    use SoftDeletes;
    protected $table = 'tshirts';

    protected $fillable = [
        'name',
        'size',
        'price',
        'cost_price',
        'available_qty',
        'description'
    ];

    public function tshirtSales()
    {
        return $this->hasMany(TshirtSale::class, 'tshirt_id');
    }

    public function tshirtStocks()
    {
        return $this->hasMany(TshirtStock::class, 'tshirt_id');
    }
}
