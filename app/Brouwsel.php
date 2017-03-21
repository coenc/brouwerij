<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\BrouwselScope;

class Brouwsel extends Model
{
	protected $table = 'brouwsels';

	protected $fillable = ['group_id', 'datum', 'liters', 'opmerking', 'biersoort_id'];

    public function beersort(){
    	return $this->belongsTo('App\Beersort', 'biersoort_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BrouwselScope);
    }

}
