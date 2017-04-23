<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\ReceptScope;

class Recept extends Model
{
    protected $table = 'recepten';
    protected $fillable = ['group_id', 'biersoort_id', 'grondstof_id', 'hoeveelheid'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReceptScope);
    }

    public function biersoort(){
    	return $this->belongsTo('App\Beersort', 'biersoort_id');
    }

    public function grondstof(){
    	return $this->belongsTo('App\Grondstof', 'grondstof_id');
    }

}
