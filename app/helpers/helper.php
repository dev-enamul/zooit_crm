<?php

use App\Models\District;

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

 

