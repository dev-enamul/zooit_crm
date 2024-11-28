<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'visitor_id',
        'user_id', 
        'ref_id',
        'service_id',
        'find_media_id',
        'type',
        'remark',
        'company_dob',
        'last_stpe',
        'purchase_possibility',
        'approve_by',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
     
    
 
    public function prospecting(){
        return $this->hasOne(Prospecting::class,'customer_id');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function cold_calling(){
        return $this->hasOne(ColdCalling::class,'customer_id');
    }

    public function lead(){
        return $this->hasOne(Lead::class,'customer_id');
    }

    public function presentation(){
        return $this->hasOne(Presentation::class,'customer_id');
    }

    public function followup(){
        return $this->hasOne(followup::class,'customer_id');
    }
    public function negotiation(){
        return $this->hasOne(Negotiation::class,'customer_id');
    }

    public function project(){
        return $this->hasOne(Project::class,'customer_id');
    } 
    public function sub_project(){
        return $this->belongsTo(SubProject::class,'project_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reference() {
        return $this->belongsTo(User::class, 'ref_id')->withDefault();
    }

    public function profession() {
        return $this->belongsTo(Profession::class, 'profession_id');
    } 

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

   public function next_payment_date(){
        $last_deposit = $this->deposits()->where('deposit_category_id', 1)->latest()->first();

        if (!$last_deposit || $last_deposit == null) {
            return Carbon::now()->toDateString();
        }
        $last_payment_date = Carbon::parse($last_deposit->date);
        $installment_type  = $this->salse->installment_type;
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
        return $next_payment_date->toDateString();
    }

    function dueInstallment() {
        $number_of_installments_due = 0;
        $current_date               = Carbon::now()->endOfMonth();
        $number_of_installments_due = 0;
        $next_date                  = $this->next_payment_date();
        $next_date                  = Carbon::parse($next_date);
        $installment_type           = $this->salse->installment_type;
        while ($next_date <= $current_date) {
            if ($next_date->isSameMonth(now())) {
                $number_of_installments_due++;
            }
            switch ($installment_type) {
            case 'weekly':
                $next_date->addWeek();
                break;
            case 'bi-weekly':
                $next_date->addWeeks(2);
                break;
            case 'monthly':
                $next_date->addMonth();
                break;
            case 'bi-monthly':
                $next_date->addMonths(2);
                break;
            case 'quarterly':
                $next_date->addMonths(3);
                break;
            case 'semi-annually':
                $next_date->addMonths(6);
                break;
            case 'annually':
                $next_date->addYear();
                break;
            default:
                break;
            }
        }
        return $number_of_installments_due;
    }

    function overDueInstallment() {
        $number_of_installments_due = 0;
        $current_date               = Carbon::now()->firstOfMonth()->subDay(1);
        // $firstDayOfMonth = Carbon::now()->firstOfMonth();
        // $lastDayOfMonth = Carbon::now()->endOfMonth();
        $number_of_installments_due = 0;
        $next_date                  = $this->next_payment_date();
        $next_date                  = Carbon::parse($next_date);
        $installment_type           = $this->salse->installment_type;
        while ($next_date <= $current_date) {
            $number_of_installments_due++;
            switch ($installment_type) {
            case 'weekly':
                $next_date->addWeek();
                break;
            case 'bi-weekly':
                $next_date->addWeeks(2);
                break;
            case 'monthly':
                $next_date->addMonth();
                break;
            case 'bi-monthly':
                $next_date->addMonths(2);
                break;
            case 'quarterly':
                $next_date->addMonths(3);
                break;
            case 'semi-annually':
                $next_date->addMonths(6);
                break;
            case 'annually':
                $next_date->addYear();
                break;
            default:
                break;
            }
        }
        return $number_of_installments_due;
    }
}
