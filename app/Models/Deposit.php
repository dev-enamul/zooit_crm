<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'project_id',
        'invoice_id',
        'amount',
        'date',
        'bank_id',
        'tnx_id',
        'remark',
        'document'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function project()
{
    return $this->belongsTo(Project::class);
}

public function invoice()
{
    return $this->belongsTo(Invoice::class)->withTrashed(); // Use `withTrashed` if soft deletes are used.
}

public function bank()
{
    return $this->belongsTo(Bank::class);
}

}
