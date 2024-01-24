 <?php  

use Illuminate\Support\Str;
 
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
            return '';  
        }

        return date($format, $timestamp);
    }
}

if (!function_exists('get_price')) {
    function get_price($amount,$decimal = 0)
    { 
        return '৳' . number_format($amount,$decimal);
    }
}