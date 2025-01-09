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
        'size_id',
        'cost',
        'total_cost',
        'stocked_at',
    ];

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
        static::creating(function ($stock) {
            $tshirt = Tshirt::find($stock->tshirt_id);
            $size = Size::find($stock->size_id);

            // Ensure cost is used for total_cost calculation
            $stock->total_cost = $stock->quantity * $stock->cost;

            if ($tshirt && $size) {
                // Increase stock for the specific T-shirt and size
                $tshirt->increment('available_qty', $stock->quantity);
            }
        });

        static::deleting(function ($stock) {
            $tshirt = Tshirt::find($stock->tshirt_id);
            $size = Size::find($stock->size_id);

            if ($tshirt && $size) {
                // Decrease stock for the specific T-shirt and size
                $tshirt->decrement('available_qty', $stock->quantity);
            }
        });
    }
}
