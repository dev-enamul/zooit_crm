<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id',
        'bank_id',
        'type',
        'amount',
        'invoice_id',
        'payment_date',
        'due_after_transaction',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
