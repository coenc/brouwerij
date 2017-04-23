<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\InkoopgrondstofScope;

class Inkoopgrondstof extends Model
{
    protected $table = 'inkoopgrondstof';
    protected $fillable = ['group_id', 'datum', 'grondstof_id', 'hoeveelheidkg', 'prijsexbtw'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InkoopgrondstofScope);
    }

    public function grondstof(){
    	return $this->belongsTo('App\Grondstof', 'grondstof_id')->withTrashed();
    }
    
    public function leverancier(){
    	return $this->belongsTo('App\Leverancier', 'leverancier_id');
    }
    
}
