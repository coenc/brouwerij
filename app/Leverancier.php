<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\LeverancierScope;

class Leverancier extends Model
{
    protected $table = 'leveranciers';
    protected $fillable = ['group_id', 'naam', 'factuurnaam', 'factuuradres', 'factuurpostcode', 'factuurplaats', 'contactpersoon', 'telefoon', 'mobiel', 'email', 'website', 'openingstijden', 'bankrekening', 'banknaam'];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LeverancierScope);
    }

}
