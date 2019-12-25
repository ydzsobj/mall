<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodCategory extends Model
{
    //
    protected $table = 'good_categories';

    public function goods(){
        return $this->hasMany(Good::class, 'category_id','id');
    }

    public function getImageUrlAttribute($value){
        return $value ? asset('/uploads/admin/'.$value) : '';
    }

    public function setImageUrlListAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['image_url_list'] = json_encode($pictures);
        }
    }

    public function getImageUrlListAttribute($pictures)
    {
        if($pictures){

            $urls = json_decode($pictures, true);

            $image_urls = [];

            if(count($urls) > 0){

                foreach($urls as $url){
                    array_push($image_urls, asset('/uploads/admin/'.$url));
                }

                return $image_urls;
            }

        }

    }

    public function get_data($request){

        $country_id = $request->get('country_id');
        return self::when($country_id, function($query) use ($country_id){
            $query->where('country_id', $country_id);
        })
            ->where('is_enabled', '>', 0)
            ->orderBy('sort', 'desc')
            ->select('id as category_id','show_name as name')
            ->get();
    }
}
