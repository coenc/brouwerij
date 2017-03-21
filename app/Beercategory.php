<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\BeercategoryScope;

class Beercategory extends Model
{
    protected $table = 'beercategories';
    protected $fillable = ['group_id', 'omschrijving', 'group_id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BeercategoryScope);
    }

    public function beersorts(){
    	return $this->hasMany('App\Beersort', 'beercategory_id');
    }

}
