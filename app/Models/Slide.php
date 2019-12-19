<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //
    protected $table = 'slides';

    protected $fillable = [
        'image_url',
        'sort',
        'good_id',
        'country_id'
    ];

    /**
     * @return $this
     */
    public function good(){
        return $this->belongsTo(Good::class)->withDefault();
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function get_data($request){
        $country_id = $request->get('country_id');
        return self::when($country_id, function($query) use ($country_id){
            $query->where('country_id', $country_id);
        } )
            ->orderBy('country_id', 'desc')
            ->orderBy('sort','desc')
            ->get();
    }
}
