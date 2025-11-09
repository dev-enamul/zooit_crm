<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id',
        'invoice_type',
        'customer_id',
        'project_id',
        'title',
        'description',
        'invoice_date',
        'due_date',
        'amount',
        'tax_amount',
        'discount_amount',
        'total_amount_usd',
        'usd_rate',
        'total_amount',
        'due_amount',
        'status',
        'notification_count',
        'last_notification_date',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
}
