<?php

use App\Models\District;
use App\Models\ReportingUser;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;

if (!function_exists('getSlug')) {
    function getSlug($model, $title, $column = 'slug', $separator = '-')
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while ($model::where($column, $slug)->exists()) {
            $slug = $originalSlug . $separator . $count;
            $count++;
        }

        return $slug;
    }
}

if (!function_exists('get_date')) {
    function get_date($inputDate, $format = 'j M, Y')
    {
        $timestamp = strtotime($inputDate);

        if ($timestamp === false || $timestamp < 0) {
            return '-';
        }

        return date($format, $timestamp);
    }
}

if (!function_exists('get_price')) {
    function get_price($amount, $decimal = 0)
    {
        return  number_format($amount, $decimal) .' Tk';
    }
}

if (!function_exists('districts')) {
    function districts(int $division_id = null)
    {
        return District::withOutGlobalScopes()
            ->when($division_id, function ($q) use ($division_id) {
                $q->where('division_id', $division_id);
            })->get();
    }
}

if (!function_exists('upazilas')) {
    function upazilas(int $district_id = null, int $division_id = null)
    {
        #dd($district_id);
        return Upazila::withOutGlobalScopes()
            ->when($district_id, function ($q) use ($district_id) {
                $q->where('district_id', $district_id);
            })->get();
    }
}

if (!function_exists('unions')) {
    function unions(int $upazila_id = null, int $district_id = null, int $division_id = null)
    {
        return Union::withOutGlobalScopes()
            ->when($upazila_id, function ($q) use ($upazila_id) {
                $q->where('upazila_id', $upazila_id);
            })->get();
    }
}

if (!function_exists('villages')) {
    function villages(int $union_id = null, int $upazila_id = null, int $district_id = null, int $division_id = null)
    {
        return Village::withOutGlobalScopes()
            ->when($union_id, function ($q) use ($union_id) {
                $q->where('union_id', $union_id);
            })->get();
    }
}


if (!function_exists('get_percent')) {
    function get_percent($numerator, $denominator)
    {
        if ($denominator != 0) {
            return ($numerator / $denominator) * 100 .'%';
        } else {
            return 0;  
        }
    }
}

function get_phone($phoneNumber) { 
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber); 
    if (substr($phoneNumber, 0, 4) === '8801') { 
        $phoneNumber = substr($phoneNumber, 4);
    } elseif (substr($phoneNumber, 0, 2) === '01') { 
        $phoneNumber = substr($phoneNumber, 2);
    }
    
    return '01'.$phoneNumber;
}


if (!function_exists('getOrganogram')) {
    function getOrganogram($user)
    {
        $organogram = [
            'user' => $user,
            'downlines' => [],
        ];
        $users = $user->downlines;
        if ($users) {
            foreach ($users as $downline) {
                $organogram['downlines'][] = getOrganogram($downline);
            }
        }
        return $organogram;
    }
} 
 

if (!function_exists('user_reporting')) {
    function user_reporting($user_id, $users = [])
    {
        $reporting = \App\Models\ReportingUser::where('user_id', $user_id)->first();
        if (!$reporting->reporting_user_id) {
            return array_merge($users, [$user_id]);
        } else {
            return user_reporting($reporting->reporting_user_id, array_merge($users, [$user_id]));
        }
    }
}
 

if (!function_exists('user_info')) {
    function user_info($user_id)
    {
        $user = \App\Models\User::find($user_id);
        if ($user) {
            return $user;
        }
    }
}

if (!function_exists('my_employee')) {
    function my_employee($user_id)
    {
        
        $reporting_id = ReportingUser::where('user_id', $user_id)->whereNull('deleted_at')->first('id');
        if ($reporting_id) {  
            $my_employee_id = ReportingUser::where('reporting_user_id', $reporting_id->id)->whereNull('deleted_at')->pluck('user_id')->toArray();
            return $my_employee_id;
        }
    }
}

if (!function_exists('my_all_employee')) {
    function my_all_employee($user)
    {
        if (is_int($user)) {
            $user = \App\Models\ReportingUser::where('user_id', $user)->whereNull('deleted_at')
                ->select(['id', 'user_id'])
                ->first();
        }

        $userIds = [$user->user_id]; 
        $downlines = $user->downlines;
        if ($downlines) {
            foreach ($downlines as $downline) {
                $userIds = array_merge($userIds, my_all_employee($downline));
            }
        }

        return $userIds;
    }
}

 

