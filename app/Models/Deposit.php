<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes; 
    protected $fillable = [
        'customer_id',
        'customer_user_id',
        'employee_id',
        'deposit_category_id',
        'project_id',
        'salse_id',
        'amount',
        'date',
        'bank_id',
        'tnx_id',
        'branch_name',
        'remark',
        'approve_by',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = [
        'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 

    public function commissions(){
        return $this->hasMany(DepositCommission::class);
    }

    public function depositCategory()
    {
        return $this->belongsTo(DepositCategory::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function salse()
    {
        return $this->belongsTo(Salse::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function destroyer()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    } 

    public static function getDeposit($user_id, $monthOffset)
    {
        $targetMonth = date('m', strtotime("-$monthOffset month"));
        $targetYear = date('Y');  
        $user = User::find($user_id);
        $my_all_employee = json_decode($user->user_employee);
 
        return self::whereHas('customer', function ($q) use ($my_all_employee) {
                $q->whereIn('ref_id', $my_all_employee);
            })
            ->whereNotNull('approve_by')
            ->whereMonth('date', $targetMonth)
            ->whereYear('date', $targetYear)
            ->sum('amount');
    }
}
