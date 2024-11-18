<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tshirt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'size',
        'available_qty',
        'description'
    ];   
}
