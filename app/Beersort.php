<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\BeersortScope;

class Beersort extends Model
{
	protected $table = 'beersorts';

    use SoftDeletes;

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

    /**
     * Scope a query to only include products from a product category.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $cat_id)
    {
        return $query->where('beercategory_id', $cat_id);
    }


    // public function brouwsels(){
    //     return $this->hasMany('App\Brouwsel');
    // }
    
    // public function recepten(){
    //     return $this->hasMany('App\Recept');
    // }

}
