<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplementSale extends Model
{
    use SoftDeletes;
    protected $table = 'supplement_sales';
    protected $fillable = ['supplement_id','quantity','total_price'];


    public function supplement()
    {
        return $this->belongsTo(Supplements::class);
    }

    // Automatically adjust the available quantity when a sale is created
    protected static function booted()
    {
        static::creating(function ($sale) {
            $supplement = Supplements::find($sale->supplement_id);

            // Calculate total price
            $sale->total_price = $sale->quantity * $supplement->price;

            // Reduce stock
            $supplement->decrement('available_qty', $sale->quantity);
        });

        // Restore stock if the sale is deleted
        static::deleting(function ($sale) {
            $sale->supplement->increment('available_qty', $sale->quantity);
        });
    }
}
