<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TshirtSale extends Model
{
    use SoftDeletes;
    protected $table = 'tshirt_sales';
    protected $fillable = ['tshirt_id','size_id','quantity','total_price'];


    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class,'id');
    }

    public function sizes()
    {
        return $this->belongsTo(Size::class,'id');
    }

    // Automatically adjust the available quantity when a sale is created
    protected static function booted()
    {
        static::creating(function ($sale) {
            $tshirt = Tshirt::find($sale->tshirt_id);
            $size = Size::find($sale->size_id);

            // Ensure cost is used for total_cost calculation
            $sale->total_price = $sale->quantity * $tshirt->price;

            if ($tshirt && $size) {
                // Reduce stock for the specific T-shirt and size
                $tshirt->decrement('available_qty', $sale ->quantity);
            }
        });

        static::deleting(function ($sale) {
            $tshirt = Tshirt::find($sale->tshirt_id);
            $size = Size::find($sale->size_id);

            if ($tshirt && $size) {
                // Increase stock for the specific T-shirt and size if a sale is deleted
                $tshirt->increment('available_qty', $sale->quantity);
            }
        });
    }
}
