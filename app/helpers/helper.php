<?php

use App\Models\District;
use App\Models\ReportingUser;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Village;
use function Laravel\Prompts\select;
use Illuminate\Support\Str;

if (!function_exists('getSlug')) {
    function getSlug($model, $title, $column = 'slug', $separator = '-') {
        $slug         = Str::slug($title);
        $originalSlug = $slug;
        $count        = 1;

        while ($model::where($column, $slug)->exists()) {
            $slug = $originalSlug . $separator . $count;
            $count++;
        }

        return $slug;
    }
}

if (!function_exists('get_date')) {
    function get_date($inputDate, $format = 'j M, Y', $timezone = 'Asia/Dhaka') {
        try {
            if($inputDate==null){
                return "-";
            }
            $date = new DateTime($inputDate);
            // $date->setTimezone(new DateTimeZone($timezone));
            return $date->format($format);
        } catch (Exception $e) {
            return '-';
        }
    }
}

if (!function_exists('get_price')) {
    function get_price($amount, $currency = 'bdt', $decimal = 0) {
        $icon = $currency === 'usd' ? '$' : '৳';
        return $icon . number_format($amount, $decimal, '.', ',');
    }
}


if (!function_exists('usd_to_bdt_rate')) {
    function usd_to_bdt_rate() { 
        $api_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response = file_get_contents($api_url);
        $data = json_decode($response, true);

        if (isset($data['rates']['BDT'])) {
            $usd_to_bdt_rate = $data['rates']['BDT'];
        } else {
            $usd_to_bdt_rate = 120;  
        }
        return $usd_to_bdt_rate;
    }
}




if (!function_exists('districts')) {
    function districts(int $division_id = null) {
        return District::withOutGlobalScopes()
            ->when($division_id, function ($q) use ($division_id) {
                $q->where('division_id', $division_id);
            })->get();
    }
}

if (!function_exists('upazilas')) {
    function upazilas(int $district_id = null, int $division_id = null) {
        #dd($district_id);
        return Upazila::withOutGlobalScopes()
            ->when($district_id, function ($q) use ($district_id) {
                $q->where('district_id', $district_id);
            })->get();
    }
}

if (!function_exists('unions')) {
    function unions(int $upazila_id = null, int $district_id = null, int $division_id = null) {
        return Union::withOutGlobalScopes()
            ->when($upazila_id, function ($q) use ($upazila_id) {
                $q->where('upazila_id', $upazila_id);
            })->get();
    }
}

if (!function_exists('villages')) {
    function villages(int $union_id = null, int $upazila_id = null, int $district_id = null, int $division_id = null) {
        return Village::withOutGlobalScopes()
            ->when($union_id, function ($q) use ($union_id) {
                $q->where('union_id', $union_id);
            })->get();
    }
}

if (!function_exists('target_cal')) {
    function target_cal($target, $total_days, $diff) {
        return round(($target / $total_days) * $diff);
    }
}

if (!function_exists('get_percent')) {
    function get_percent($numerator, $denominator) {
        if ($denominator != 0) {
            return round(($numerator / $denominator) * 100) . '%';
        } else {
            return 0 . '%';
        }
    }
}

function get_phone($phoneNumber) {
    // $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    // if (substr($phoneNumber, 0, 4) === '8801') {
    //     $phoneNumber = substr($phoneNumber, 4);
    // } elseif (substr($phoneNumber, 0, 2) === '0') {
    //     $phoneNumber = substr($phoneNumber, 2);
    // }

    return $phoneNumber;
}

if (!function_exists('getOrganogram')) {
    function getOrganogram($user) {
        $organogram = [
            'user'      => $user,
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

// if (!function_exists('user_reporting')) {
//     function user_reporting($user_id, $users = [])
//     {
//         $reporting = \App\Models\ReportingUser::where('user_id', $user_id)->where('status',1)->latest()->first();
//         if(isset($reporting->reporting_user_id) && $reporting->reporting_user_id != null){
//             $newreporting = \App\Models\ReportingUser::find($reporting->reporting_user_id);
//             if(isset($newreporting->user_id) && $newreporting->user_id != null){
//                 return user_reporting($newreporting->user_id, array_merge($users, [$reporting->user_id]));
//             }else{
//                 return $users;
//             }
//         }elseif(isset($reporting->user_id) && $reporting->user_id != null){
//             return array_merge($users, [$reporting->user_id]);
//         }else{
//             return $users;
//         }
//     }
// }

if (!function_exists('user_reporting')) {
    function user_reporting($user_id, $users = []) {
        $reporting = \App\Models\ReportingUser::where('user_id', $user_id)->latest()->where('status', 1)->first();
        if (!$reporting) {
            return $users;
        }
        if (!$reporting->reporting_user_id || $reporting->reporting_user_id == null) {
            return array_merge($users, [$user_id]);
        } else {
            $next_reporting = \App\Models\ReportingUser::find($reporting->reporting_user_id);
            if (isset($next_reporting) && $next_reporting->user_id != null) {
                return user_reporting($next_reporting->user_id, array_merge($users, [$user_id]));
            }
            return array_merge($users, [$user_id]);

        }
    }
}

if (!function_exists('user_info')) {
    function user_info($user_id) {
        $user = \App\Models\User::find($user_id);
        if ($user) {
            return $user;
        }
    }
}

if (!function_exists('my_employee')) {
    function my_employee($user_id) {
        $reporting_id = ReportingUser::where('user_id', $user_id)->whereNull('deleted_at')->first('id');
        if ($reporting_id) {
            $my_employee_id = ReportingUser::where('reporting_user_id', $reporting_id->id)
                ->whereNull('deleted_at')
                ->pluck('user_id')
                ->toArray();
            return $my_employee_id;

        } else {
            return [];
        }
    }
}

if (!function_exists('my_all_employee')) {
    function my_all_employee($user) {
        if (is_int($user)) {
            $user = \App\Models\ReportingUser::where('user_id', $user)->whereNull('deleted_at')
                ->select(['id', 'user_id'])
                ->first();
        }

        if (isset($user->user_id) && $user->user_id != null) {
            $userIds   = [$user->user_id];
            $downlines = $user->downlines;
            if ($downlines) {
                foreach ($downlines as $downline) {
                    $userIds = array_merge($userIds, my_all_employee($downline));
                }
            }
        }

        return $userIds ?? [];
    }

    if (!function_exists('inChargeEmployee')) {
        function inChargeEmployee($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('employee', function ($q) {
                    // $q->whereJsonContains('designations', '12')
                    //     ->orWhereJsonContains('designations', '13')
                    //     ->orWhereJsonContains('designations', '14')
                    //     ->orWhereJsonContains('designations', '15');
                    $q->whereIn('designation_id', [12, 13, 14, 15]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('areaInChargeEmployee')) {
        function areaInChargeEmployee($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('employee', function ($q) {
                    // $q->whereJsonContains('designations','11');
                    $q->whereIn('designation_id', [11]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('marketingInChargeEmployee')) {
        function marketingInChargeEmployee($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('employee', function ($q) {
                    // $q->whereJsonContains('designations','16');
                    $q->whereIn('designation_id', [16]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('salesInChargeEmployee')) {
        function salesInChargeEmployee($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('employee', function ($q) {
                    // $q->whereJsonContains('designations', '12')
                    //     ->orWhereJsonContains('designations', '13')
                    //     ->orWhereJsonContains('designations', '14')
                    //     ->orWhereJsonContains('designations', '15');
                    $q->whereIn('designation_id', [12, 13, 14, 15]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('zonalManagerEmployee')) {
        function zonalManagerEmployee($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('employee', function ($q) {
                    // $q->whereJsonContains('designations','10');
                    $q->whereIn('designation_id', [10]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('exCoOrdinator')) {
        function exCoOrdinator($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('freelancer', function ($q) {
                    $q->whereIn('designation_id', [17]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    }

    if (!function_exists('coOrdinator')) {
        function coOrdinator($reporting) {
            if (isset($reporting) && $reporting != null) {
                $user = User::whereIn('id', $reporting)->whereHas('freelancer', function ($q) {
                    $q->whereIn('designation_id', [18]);
                })->first();
                if (isset($user) && $user != null) {
                    return $user->name . ' [' . $user->user_id . ']';
                }
            }
            return "-";
        }
    } 

    if (!function_exists('customEncrypt')) {
        function customEncrypt($id) {
            $key = 123456;  
            return base_convert($id ^ $key, 10, 36);  
        }
    }
    
    if (!function_exists('customDecrypt')) {
        function customDecrypt($code) {
            $key = 123456;  
            return base_convert($code, 36, 10) ^ $key;  
        }
    }  
    
    

    if (!function_exists('success_response')) {
        function success_response($data = null, $message = 'Success', $statusCode = 200)
        {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data, 
                'timestamp' => now()->toIso8601String(),
                'request_id' => request()->header('X-Request-ID') ?: uniqid(),
            ], $statusCode);
        }
    }

    if (!function_exists('error_response')) {
        function error_response( $errors = null, $statusCode = 400, $message = 'An error occurred')
        {
            if ($statusCode == 0) {
                $statusCode = 400;  
            }
            
            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => null,
                'errors' => $errors,
                'timestamp' => now()->toIso8601String(),
                'request_id' => request()->header('X-Request-ID') ?: uniqid(),
            ], $statusCode);
        }
    }
    

}
