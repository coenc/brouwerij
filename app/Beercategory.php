<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\BeercategoryScope;

class Beercategory extends Model
{

    protected $table = 'beercategories';
    protected $fillable = ['group_id', 'omschrijving', 'group_id'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BeercategoryScope);
    }

    public function beersorts(){
    	return $this->hasMany('App\Beersort', 'beercategory_id');
    }

    // public function recepten(){
    //     //https://laravel.com/docs/5.4/eloquent-relationships#many-to-many
    //     // return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    //     // The third argument is the foreign key name of the model on which you are defining the relationship, while the fourth argument is the foreign key name of the model that you are joining to:
    //     return $this->belongsToMany('App\Recept', 'beersorts', 'id', 'beercategory_id');
    // }

}
