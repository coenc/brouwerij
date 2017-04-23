<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class VoorraadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $group_id = Auth::user()->group->id;

		$db_verbruikgrondstof = DB::table('brouwsels')
            ->join('beersorts', 'brouwsels.biersoort_id', '=', 'beersorts.id')
            ->join('recepten', 'beersorts.id', '=', 'recepten.biersoort_id')
            ->join('grondstoffen', 'grondstoffen.id', '=', 'recepten.grondstof_id')
            ->select('brouwsels.datum', 'brouwsels.liters', 'beersorts.omschrijving AS bier','grondstoffen.naam as grondstof',
                    DB::raw('recepten.hoeveelheid * brouwsels.liters AS hoeveelheidkg'))
            ->where('brouwsels.group_id', $group_id)
            ->orderBy('datum', 'desc')
            ->get();

        // var_dump($db_verbruikgrondstof);die;
        
        return view('voorraden.index')->with('voorraadgrondstoffen', $db_verbruikgrondstof);

    }
}
