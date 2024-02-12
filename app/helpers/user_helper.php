<?php  
use App\Models\ReportingUser;

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

if (!function_exists('reporting_user')) {
    function reporting_user($reporting_id)
    {
        $reporting_user = \App\Models\ReportingUser::find($reporting_id);
        if ($reporting_user->user_id != null) {
            return user_info($reporting_user->user_id);
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
        $reporting_id = ReportingUser::where('user_id', $user_id)->first('id');
        if ($reporting_id) { 
            $my_employee_id = ReportingUser::where('reporting_user_id', $reporting_id->id)->pluck('user_id')->toArray();
            return $my_employee_id;
        }
    }
}

if (!function_exists('my_all_employee')) {
    function my_all_employee($user)
    {
        if (is_int($user)) {
            $user = \App\Models\ReportingUser::where('user_id', $user)
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
