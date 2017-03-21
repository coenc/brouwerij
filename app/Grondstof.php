<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\GrondstofScope;

class Grondstof extends Model
{
    protected $table = 'grondstoffen';
    protected $fillable = ['group_id', 'naam', 'grondstofcategorie_id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GrondstofScope);
    }

    public function grondstofcategorie(){
		return $this->belongsTo('App\Grondstofcategorie', 'grondstofcategorie_id');
	}

	public function grondstofinkopen(){
		return $this->hasMany('App\Inkoopgrondstof', 'grondstof_id');
	}

}
