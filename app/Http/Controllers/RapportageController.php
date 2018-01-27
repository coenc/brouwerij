<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Brouwsel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Beersort;
use Response;

class RapportageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accijnsAfdracht(){

        $group_id = Auth::user()->group->id;

        $data = DB::table('brouwsels')
            ->join('beersorts', 'brouwsels.biersoort_id', '=', 'beersorts.id')
            ->join('accijnstarifs', 'accijnstarifs.id', '=', 'beersorts.accijnstarif_id')
            ->select('datum', 'liters', 'omschrijving', 'tariefperhl', DB::raw('ROUND(tariefperhl*liters/1000,2) AS afdracht'))
            ->where('brouwsels.group_id', $group_id)
            ->orderBy('datum', 'desc')
            ->get();

        $total = DB::table('brouwsels')
            ->join('beersorts', 'brouwsels.biersoort_id', '=', 'beersorts.id')
            ->join('accijnstarifs', 'accijnstarifs.id', '=', 'beersorts.accijnstarif_id')
            ->select(DB::raw('SUM(ROUND(tariefperhl*liters/1000,2)) AS total'))
            ->where('brouwsels.group_id', $group_id)
            ->get();

        // dd($total);
        return view('rapportages.accijnsafdracht')->with('data', $data)
                                                  ->with('total', $total);

    }

    public function productie(){

        $group_id = Auth::user()->group->id;

        $xas = array();
        $data = array();

        $datums = DB::table('brouwsels')
                    ->select('datum')
                    ->where('group_id','=', $group_id)
                    ->whereRaw('ISNULL (deleted_at)')
                    ->groupby('datum')
                    ->orderBy('datum', 'ASC')
                    ->get();
        echo('<pre>');
        var_dump(json_encode($datums));
        echo('</pre>');

        foreach ($datums as $datum) {
            
            $xas[] = $datum->datum;

            $bieren = DB::table('beersorts')
                                ->select('id', 'omschrijving' )
                                ->where('group_id','=', $group_id)
                                ->whereRaw('ISNULL (deleted_at)')
                                ->orderBy('id', 'ASC')
                                ->get();

            $values = array();
            foreach ($bieren as $bier) {

                $brouwdata = DB::table('brouwsels')
                            ->select(DB::raw('biersoort_id, datum, liters'))
                            ->where([['brouwsels.group_id', '=', $group_id], ['biersoort_id', '=', $bier->id], ['datum', '=', $datum->datum]])
                            ->whereRaw('ISNULL (deleted_at)')
                            ->orderBy('datum', 'ASC')
                            ->orderBy('biersoort_id', 'ASC')
                            ->get();
                
                $liters = 0;

                foreach ($brouwdata as $brdat) {
                    $liters = $liters + (int)$brdat->liters;
                }

                $values[] = $liters;

            }

            $data[] = array('name' => $bier->omschrijving, 'data' => $values);
            unset( $values);
            
        }


        $biersoorten = DB::table('beersorts')
                    ->select('omschrijving')
                    ->where('group_id','=', $group_id)
                    ->whereRaw('ISNULL (deleted_at)')
                    ->orderBy('id', 'ASC')
                    ->get();
        echo('<pre>');
        var_dump(json_encode($biersoorten));
        echo('</pre>');






        echo('<pre>');
        echo(json_encode($xas));
        echo('<br>');
        echo(json_encode($data));
        echo('</pre>');


        return view('rapportages.rapportageproductie')
                ->with('xas', json_encode($xas))
                ->with('myData', json_encode($data));
        
    }    

}
