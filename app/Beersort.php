<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\BeersortScope;

class Beersort extends Model
{
	protected $table = 'beersorts';
	protected $fillable = ['code', 'group_id', 'omschrijving', 'toelichting', 'beercategory_id', 
                            'accijnstarif_id', 'image', 'vastofseizoen', 
                            'ogmin','ogmax','fgmin','fgmax','alcvolmin', 
                            'alcvolmax', 'ebumin', 'ebumax', 'ebcmin', 'ebcmax'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BeersortScope);
    }

    public function beercategory(){
    	return $this->belongsTo('App\Beercategory', 'beercategory_id');
    }

    public function accijnstarif(){
    	return $this->belongsTo('App\Accijnstarif', 'accijnstarif_id');
    }


    // public function brouwsels(){
    //     return $this->hasMany('App\Brouwsel');
    // }
    
    // public function recepten(){
    //     return $this->hasMany('App\Recept');
    // }

}
