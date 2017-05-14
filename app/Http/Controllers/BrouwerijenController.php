<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brouwerij;
use Response;

class BrouwerijenController extends Controller
{
	public function index()

    {
    	// $brouwerijen = Brouwerij::all()->sortBy('id');	
    	// $brouwerijen = json_encode($brouwerijen);
    	// echo($brouwerijen);

        return view('brouwerijen.index')->with('brouwerijen');
        
    }

    public function brouwerijen()
    {
    	$brouwerijen = Brouwerij::all()->sortBy('id');
    	// $brouwerijen = json_encode($brouwerijen);
    	return Response::json($brouwerijen);
    }
}
