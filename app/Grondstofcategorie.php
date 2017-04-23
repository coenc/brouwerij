<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\GrondstofcategoryScope;

class Grondstofcategorie extends Model
{
    protected $table = 'grondstofcategorie';
    protected $fillable = ['group_id', 'omschrijving'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GrondstofcategoryScope);
    }

    public function grondstoffen(){
		return $this->hasMany('App\Grondstof', 'grondstofcategorie_id');
    }



}
