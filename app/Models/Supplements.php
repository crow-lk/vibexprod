<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplements extends Model
{
    use SoftDeletes;
    protected $table = 'supplements';
    protected $fillable = ['name','price','available_qty','description','cost_price'];
    

    public function supplementSales()
    {
        return $this->hasMany(SupplementSale::class, 'supplement_id');
    }
}
