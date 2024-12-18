<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'deposit_category_id');
    }
}
