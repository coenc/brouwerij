<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Woonplaats;

class WoonplaatsController extends Controller
{

    public function getWoonplaatsen(Request $request)
    {

    	$filter = $request->input('term');
    	
        $woonplaatsen = DB::table('woonplaatsen')->where('plaats', 'LIKE', '%' . $filter . '%')->get();
        
        return response()->json($woonplaatsen);
    }

}
