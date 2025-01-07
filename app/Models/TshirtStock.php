<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TshirtStock extends Model
{
    use SoftDeletes;

    protected $table = 'tshirt_stocks';

    protected $fillable = [
        'tshirt_id',
        'quantity',
        'cost',
        'total_cost',
        'stocked_at',
    ];

    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class);
    }

    // Automatically adjust the available quantity when a sale is created
    protected static function booted()
    {
        static::creating(function ($stock) {
            $tshirt = Tshirt::find($stock->tshirt_id);

            // Ensure cost is used for total_cost calculation
            $stock->total_cost = $stock->quantity * $stock->cost;

            if ($tshirt) {
                // Increase stock
                $tshirt->increment('available_qty', $stock->quantity);
            }
        });

        // Restore stock if the sale is deleted
        static::deleting(function ($stock) {
            if ($stock->tshirt) {
                $stock->tshirt->decrement('available_qty', $stock->quantity);
            }
        });
    }
}
