<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table = 'groups';
	protected $fillable = ['id', 'groupname', 'naam', 'adres', 'postcode', 'woonplaats', 'email'];
	
}
