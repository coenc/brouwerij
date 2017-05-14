<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrouwerijenController extends Controller
{
	public function index()
    {
        return view('brouwerijen.index');
    }
}
