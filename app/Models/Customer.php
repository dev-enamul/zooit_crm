<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_id', 
        'profession_id',
        'name',
        'ref_id',
        'status',
        'created_by',
        'approve_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reference()
    {
        return $this->belongsTo(User::class, 'ref_id')->withDefault(); 
    }

    public function profession(){
        return $this->belongsTo(Profession::class,'profession_id');
    }

    public function salse(){
        return $this->hasOne(Salse::class,'customer_id');
    }

    public function deposits(){
        return $this->hasMany(Deposit::class,'customer_id');
    }

   public function nextPaymentDate(){
        $last_payment_date = $this->deposits()->latest()->first()->date;
        if(!$last_payment_date){
            return $next_payment_date = now();
        }
        $installment_type = $this->salse->installment_type;
        switch ($installment_type) {
            case 'weekly':
                $next_payment_date = $last_payment_date->addWeek(); 
                break;
            case 'bi-weekly':
                $next_payment_date = $last_payment_date->addWeeks(2); 
                break;
            case 'monthly':
                $next_payment_date = $last_payment_date->addMonth(); 
                break;
            case 'bi-monthly':
                $next_payment_date = $last_payment_date->addMonths(2); 
                break;
            case 'quarterly':
                $next_payment_date = $last_payment_date->addMonths(3); 
                break;
            case 'semi-annually':
                $next_payment_date = $last_payment_date->addMonths(6); 
                break;
            case 'annually':
                $next_payment_date = $last_payment_date->addYear(); 
                break;
            default: 
                break;
        }
        return $next_payment_date;
   }

   function dueInstallment(){
        $number_of_installments_due = 0; 
        $current_date = now();
        $number_of_installments_due = 0;
        $next_payment_date = $this->nextPaymentDate();
        $installment_type = $this->salse->installment_type;
        while ($next_payment_date <= $current_date) {
            $number_of_installments_due++;
            switch ($installment_type) {
                    case 'weekly':
                        $next_payment_date->addWeek();
                        break;
                    case 'bi-weekly':
                        $next_payment_date->addWeeks(2);
                        break;
                    case 'monthly':
                        $next_payment_date->addMonth();
                        break;
                    case 'bi-monthly':
                        $next_payment_date->addMonths(2);
                        break;
                    case 'quarterly':
                        $next_payment_date->addMonths(3);
                        break;
                    case 'semi-annually':
                        $next_payment_date->addMonths(6);
                        break;
                    case 'annually':
                        $next_payment_date->addYear();
                        break;
                    default: 
                        break;
                }
            }
        
        }
}
