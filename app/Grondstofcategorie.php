<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\GrondstofcategoryScope;

class Grondstofcategorie extends Model
{
    protected $table = 'grondstofcategorie';
    protected $fillable = ['group_id', 'omschrijving'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GrondstofcategoryScope);
    }

    public function beersorts(){
		return $this->hasMany('App\Grondstof', 'grondstofcategory_id');
    }

}
