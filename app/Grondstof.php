<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\GrondstofScope;

class Grondstof extends Model
{
    protected $table = 'grondstoffen';
    protected $fillable = ['group_id', 'naam', 'grondstofcategorie_id'];
    use SoftDeletes;

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

    /**
     * Scope a query to only include grondstoffen from a grondstofcategorie.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $cat_id)
    {
        return $query->where('grondstofcategorie_id', $cat_id);
    }

}
