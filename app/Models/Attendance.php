<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'attendance';
    protected $fillable = ['member_id','check_in_time','check_out_time','status'];

    public function member()
    {
        return $this->belongsTo(Members::class);
    }
}

