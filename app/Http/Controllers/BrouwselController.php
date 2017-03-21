<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Brouwsel;
use App\Inkoopgrondstof;
use App\Beersort;
Use App\Grondstof;
Use App\Recept;
use Response;
Use Log;
use Illuminate\Support\Facades\DB;

class BrouwselController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group_id = Auth::user()->group->id;

        // $brouwsels = Brouwsel::where('group_id', $group_id)->orderBy('datum','desc')->get();
        $brouwsels = Brouwsel::all();
        $beersorts = Beersort::all();
       
        //Build array for dropdown biersoort 
        $beersrtn = array();
        foreach ($beersorts as $beersort) {
             $beersrtn[$beersort->id] = $beersort->code . ' ' . $beersort->omschrijving; 
        }

        return view('brouwen.index')->with('brouwsels', $brouwsels)
                                    ->with('beersoorts', $beersorts)
                                    ->with('beersrtn', $beersrtn);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Check availabilty grondstoffen
        $warning = false;
        $warninggrondstoffen = array();
        $biersrt = $request->biersoort_id;
        $ltrs = $request->liters;
        // echo ('Biersoort=' . $biersrt);
        // echo ('Liters=' . $ltrs);
        // echo ('<br>');
        Log::info('Te brouwen biersoort: ' . $biersrt  );
        Log::info('Te brouwen aant liters: ' . $ltrs  );

        $ingr = Recept::where('biersoort_id', $biersrt)->get();
        foreach ($ingr as $key => $value) {

            $grondstof = $value->grondstof_id;
            $aantalkilo = $value->hoeveelheid * $ltrs;
            
            $grondstofnaam = Grondstof::select('naam')->where('id', $grondstof)->first();
            
            Log::info('investigating availability grondstof ' . $grondstofnaam->id . '-' . $grondstofnaam->naam . " Aantal kg: " . $aantalkilo);
            Log::info('---------------------');
            $avail = $this->verbruik($grondstof, $aantalkilo);
            Log::info('----------------------------------------------------------');
            Log::info('availability: ' . print_r($avail, 1));

            if( $avail['code'] <> 200 ){
                $warning = true;
                $warninggrondstoffen[] = '<br>Tekort aan grondstof ' . $grondstofnaam->naam . ' (' . $aantalkilo . ' kg)';
            };
        }

        if ($warning){
            //echo('Waarschuwing voor grondstof(fen) tekort:' . print_r($warninggrondstoffen, 1));
            Log::info('Warning issued, no db insert');
            return Response::json(array('message' => 'ERROR',
                                        'code' => 6666,
                                        'details' => $warninggrondstoffen
                                        )
                                    );
        }else{
            // echo('Geen waarschuwingen bij invoeren brouwsel');
            Log::info('No warning issued, doing db insert');
            $group_id = Auth::user()->group->id;
            $request['group_id'] = $group_id;

            $brouwsel = Brouwsel::create($request->all());
            return Response::json($brouwsel);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($brouwsel_id)
    {
        $brouwsel = Brouwsel::find($brouwsel_id);
        return Response::json($brouwsel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brouwsel_id)
    {
        $brouwsel = Brouwsel::find($brouwsel_id);
        
        $brouwsel->datum = $request->datum;
        $brouwsel->liters = $request->liters;
        $brouwsel->opmerking = $request->opmerking;
        $brouwsel->biersoort_id = $request->biersoort_id;
        
        $brouwsel->save();

        return Response::json($brouwsel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brouwsel_id)
    {
        $bier = Brouwsel::destroy($brouwsel_id);
        return Response::json($brouwsel_id);    
    }

    private function verbruik($grondstof, $aantkg){
                
        $grstf_naam = Grondstof::select('naam')->where('id', $grondstof)->first()->naam;

        Log::info('Verbruikfunctie: id=' . $grondstof . '-' . $grstf_naam . '. Aantal kg: ' . $aantkg);

        $totaal_beschikbaar = DB::select(DB::raw('
                                            SELECT SUM(hoeveelheidkg - verbruiktkg) AS totaalbeschikbaar
                                            FROM inkoopgrondstof 
                                            WHERE grondstof_id = :grondstof
                                        '), array('grondstof' => $grondstof)
                                    );

        //Log::info(print_r($totaal_beschikbaar,1));
        $beschikbare_kg_grondstof = $totaal_beschikbaar[0]->totaalbeschikbaar;
        Log::info('Totaal beschikbare kg grondstof ' . $grstf_naam . ' = kg ' . $beschikbare_kg_grondstof);

        if ($beschikbare_kg_grondstof >= $aantkg){
            //Er is met zekerheid voldoende aanwezig van deze huidige grondstof

            //Loop through beschikbare grondstoffen, schrijf af en zoek door als nog niet voldoende bereikt  
            $te_vinden_kg = $aantkg;
            $totnutoe_gevondenkg = 0;
            $resteert_te_vinden = 0;

            $beschikbaar = DB::select(DB::raw(' SELECT id, grondstof_id, hoeveelheidkg, verbruiktkg 
                                                FROM inkoopgrondstof 
                                                WHERE grondstof_id = :grondstof
                                                AND (hoeveelheidkg - verbruiktkg) > 0 '), 
                                            array('grondstof' => $grondstof)
                                        );
            
            foreach($beschikbaar as $key => $value){

                if(($value->hoeveelheidkg - $value->verbruiktkg) >= $te_vinden_kg){
                    //Voldoende hoeveelheid gevonden. schrijf hoeveelheid af en stop met zoeken
                    
                    Log::info('Gevonden grondstof: ' . $value->grondstof_id);

                    $totnutoe_gevondenkg = $te_vinden_kg;

                    $update = Inkoopgrondstof::find($value->id);
                    $update->verbruiktkg = $value->verbruiktkg + $aantkg;
                    $update->save();
                    $resteert_te_vinden = 0;

                    break 1; //Exit foreach 1 level

                }elseif(($value->hoeveelheidkg - $value->verbruiktkg) < $te_vinden_kg){
                    //NIET genoeg, schrijf BESCHIKBARE hoeveelheid af en zoek door

                    $update = Inkoopgrondstof::find($value->id);
                    
                    $gevonden = $value->hoeveelheidkg - $value->verbruiktkg;
                    $totnutoe_gevondenkg = $totnutoe_gevondenkg + $gevonden;
                    $resteert_te_vinden = $resteert_te_vinden - $gevonden;

                    $update->verbruiktkg = $update->verbruiktkg + $gevonden;
                    $update->save();

                    if ($gevonden >= $aantkg){
                        break 1;
                    }

                }
            }

            Log::info('Grondstof in zijn totaal beschikbaar: ' . $grondstof . ' (' . $aantkg . ' kg)');            
            //Registreer verbruik in tabel Inkoopgrondstof
            $response = array();
            $response['code'] = 200;
            $response['grondstof_id'] = $grondstof;
            $response['omschr'] = '*' . $aantkg . ' kilo van grondstof '  . $grstf_naam  . ' is beschikbaar';

            return($response);
                

        }else{
            //Er is ONVOLDOENDE aanwezig van deze huidige grondstof
            Log::info('Niet voldoende grondstof. Beschikbaar = ' . $beschikbare_kg_grondstof);
            Log::info('Grondstof NIET beschikbaar: ' . $grondstof . ' (' . $aantkg . ' kg)');            
                
            $response = array();
            $response['code'] = 100;
            $response['grondstof_id'] = $grondstof;
            $response['omschr'] = '*' . $aantkg . ' kilo van grondstof '  . $grstf_naam  . ' is NIET beschikbaar';

            return($response);

        }


    }

}
