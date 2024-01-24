<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Support\Facades\Cache;

trait AreaTrait
{
    public function getCachedDivisions($minutes = 1440)
    {
        return $this->cacheData('divisions', $minutes, function () {
            return Division::select('id', 'name')->get();
        });
    }

    public function getCachedDistricts($minutes = 1440)
    {
        return $this->cacheData('districts', $minutes, function () {
            return District::select('id', 'name')->get();
        });
    }

    public function getCachedUpazilas($minutes = 1440)
    {
        return $this->cacheData('upazilas', $minutes, function () {
            return Upazila::select('id', 'name')->get();
        });
    }

    public function getCachedUnions($minutes = 1440)
    {
        return $this->cacheData('unions', $minutes, function () {
            return Union::select('id', 'name')->get();
        });
    }

    public function getCachedCountries($minutes = 1440)
    {
        return $this->cacheData('countries', $minutes, function () {
            return Country::select('id', 'name')->get();
        });
    }

    public function getCachedVillages($minutes = 1440)
    {
        return $this->cacheData('villages', $minutes, function () {
            return Village::select('id', 'name')->get();
        });
    }
    #When updating areas, clear the cache for areas example: Cache::forget('divisions');

    protected function cacheData($key, $minutes, $callback)
    {
        return Cache::remember($key, $minutes, function () use ($callback) {
            return $callback ? $callback() : null;
        });
    }
}