<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodModule extends Model
{
    //
    protected $table = 'good_modules';

    protected $fillable = [
        'sort',
        'name',
        'show_name',
        'image_url',
        'country_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods(){
        return $this->hasMany(Good::class);
    }

    public function good_module_images(){
        return $this->hasMany(GoodModuleImage::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function get_data($requst){

        $country_id = $requst->get('country_id');

        return self::with(['goods' => function($query){
            $query->select('id','title','original_price','price','good_module_id','main_image_url')->orderBy('id', 'desc');
        },'country'])
            ->when($country_id, function($query) use ($country_id){
                $query->where('country_id', $country_id);
            } )
            ->orderBy('country_id', 'desc')
            ->orderBy('sort','desc')
            ->get();
    }
}
