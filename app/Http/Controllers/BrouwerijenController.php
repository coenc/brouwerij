<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brouwerij;
use Response;

class BrouwerijenController extends Controller
{
	public function index()

    {

        return view('brouwerijen.index')->with('brouwerijen');
        
    }

    public function brouwerijen()
    {
    	$brouwerijen = Brouwerij::inRandomOrder()->limit(10)->get();
        // $brouwerijen = Brouwerij::get();
        
    	return Response::json($brouwerijen);
    }

}
