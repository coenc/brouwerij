<?php

namespace App\Http\Controllers;
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

    public function productie(){

        $xas = array();
        $arraywithvalues = array();

        $biersoorten = DB::table('beersorts')->select('id', 'omschrijving AS name')->get();

        foreach ($biersoorten as $biersoort) {
            
            $values = array();
            
            //Build values array for biersoort
            $liters = DB::table('brouwsels')->where('biersoort_id', '=', $biersoort->id)->select('liters', 'datum')->get();
            foreach ($liters as $liter) {
                $values[] = $liter->liters;
            }
            if(count($values) == 0){
                $values[] = 0;
            }

            $myData[] = array(
                        'name' => $biersoort->name,
                        'data' => $values
                        );

            $xas[] = $biersoort->name;

            unset($values);

        }      

        echo('<pre>');
        echo(print_r($xas, 1));
        echo(print_r($myData, 1));
        echo('</pre>');

        return view('rapportages.rapportageproductie')
                ->with('xas', $xas)
                ->with('myData', $myData);
            
    }    


    public function servedata(){

        $biersoorten = DB::table('beersorts')->select('id', 'omschrijving AS name')->get();


        foreach ($biersoorten as $biersoort) {
        
            $xas[] = $biersoort->name;    
            $values = array();
            
            //Build values array for biersoort
            $liters = DB::table('brouwsels')->where('biersoort_id', '=', $biersoort->id)->select('liters', 'datum')->get();
            foreach ($liters as $liter) {
                $values[] = $liter->liters;
            }
            if(count($values) == 0){
                $values[] = 0;
            }

            
            $myData['series'][] = array(
                        'name' => $biersoort->name,
                        'data' => $values
                        );

            unset($values);

        }

        $myData['categories'] = $xas;

        return Response::json($myData);

    }

}
