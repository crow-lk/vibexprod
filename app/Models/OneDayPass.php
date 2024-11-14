<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OneDayPass extends Model
{
    use SoftDeletes;
    protected $table = 'one_day_pass';
    protected $fillable = ['name','nic','phone','email','address','amount'];
}
