 <?php  

use Illuminate\Support\Str;


// Unique Slug Generate Function 
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