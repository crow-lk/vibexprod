<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'expense_category';
    protected $fillable = ['name'];

    public function expenses(){
        return $this->hasMany(Expenses::class, 'category_id');
    }
}
