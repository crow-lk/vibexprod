<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplementStock extends Model
{
    use SoftDeletes;

    protected $table = 'supplement_stocks';

    protected $fillable = [
        'supplement_id',
        'quantity',
        'cost',
        'total_cost',
        'stocked_at',
    ];

    public function supplement()
    {
        return $this->belongsTo(Supplements::class);
    }

    // Automatically adjust the available quantity when a sale is created
    protected static function booted()
    {
        static::creating(function ($stock) {
            $supplement = Supplements::find($stock->supplement_id);

            // Ensure cost is used for total_cost calculation
            $stock->total_cost = $stock->quantity * $stock->cost;

            if ($supplement) {
                // Increase stock
                $supplement->increment('available_qty', $stock->quantity);
            }
        });

        // Restore stock if the sale is deleted
        static::deleting(function ($stock) {
            if ($stock->supplement) {
                $stock->supplement->decrement('available_qty', $stock->quantity);
            }
        });
    }
}
