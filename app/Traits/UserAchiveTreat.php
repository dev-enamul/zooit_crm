<?php

namespace App\Traits;

use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\Presentation;
use App\Models\Prospecting;
use App\Models\User;
use App\Models\VisitAnalysis;
use Carbon\Carbon;

trait UserAchiveTreat
{  
    public function freelanecr_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        } 
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }
         
        $freelancer = User::whereHas('freelancer',function($q) use($my_all_employee){
            $q->whereIn('user_id',$my_all_employee);
        })
        ->where('user_type',2)
        // ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 

        return $freelancer;
    } 

    public function customer_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }
        $customer = Customer::whereIn('ref_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',$date)
            ->whereYear('created_at',$date)
            ->count();

        return $customer; 
    }

    public function prospecting_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $prospecting = Prospecting::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $prospecting; 
    }

    public function cold_calling_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }
        $cold_calling = ColdCalling::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $cold_calling; 
    } 

    public function lead_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $lead = Lead::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count();
        return $lead; 
    } 

    public function lead_analysis_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $lead_analysis = LeadAnalysis::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count();  
        return $lead_analysis; 
    } 

    public function presentation_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
       
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $presentation = Presentation::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count();  
        return $presentation; 
    } 

    public function visit_analysis_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }
        $presentation = VisitAnalysis::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count();  
        return $presentation; 
    }


    public function followup_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $followup = FollowUp::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $followup; 
    }  
    public function followup_analysis_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $data = FollowUpAnalysis::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $data; 
    } 


    public function negotiation_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
        
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $data = Negotiation::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $data; 
    } 

    public function negotiation_analysis_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   
       
        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }

        $data = NegotiationAnalysis::WhereHas('customer',function($q) use($my_all_employee){
            $q->whereIn('ref_id',$my_all_employee);
        })
        ->where('approve_by','!=',null)
        ->whereMonth('created_at',$date)
        ->whereYear('created_at',$date)
        ->count(); 
        return $data; 
    } 

    public function deposit_achive($date = null, $my_all_employee = null){
        if($date == null){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }   

        if($my_all_employee==null){
            $my_all_employee = my_all_employee($this->id);
        }
        
        $data = Deposit::whereHas('customer',function($q) use($my_all_employee){
                $q->whereIn('ref_id',$my_all_employee);
            })
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',$date)
            ->whereYear('created_at',$date)
            ->sum('amount');; 
        return $data; 
    } 

    function deposit_achive_percent($date = null){ 
        
    }
}
