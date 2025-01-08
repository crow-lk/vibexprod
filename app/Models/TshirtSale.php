<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TshirtSale extends Model
{
    use SoftDeletes;
    protected $table = 'tshirt_sales';
    protected $fillable = ['tshirt_id','size','quantity','total_price'];


    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class);
    }

    // Automatically adjust the available quantity when a sale is created
    protected static function booted()
    {
        static::creating(function ($sale) {
            $tshirt = Tshirt::find($sale->tshirt_id);

            // Ensure cost is used for total_cost calculation
            $sale->total_price = $sale->quantity * $tshirt->price;

            // Reduce stock
            $tshirt->decrement('available_qty', $sale->quantity);
        });

        // Restore stock if the sale is deleted
        static::deleting(function ($sale) {
            $sale->tshirt->increment('available_qty', $sale->quantity);
        });
    }
}
