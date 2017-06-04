<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Brouwsel;
use App\Inkoopgrondstof;
use App\Beersort;
use App\Grondstof;
use App\Recept;
use Response;
use Log;
use DB;

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

        $brouwsels = Brouwsel::all();
        $beersorts = Beersort::all();
        $beersorts = DB::table('beersorts')
                        ->join('recepten', 'beersorts.id', '=', 'recepten.biersoort_id')
                         ->select('beersorts.*')
                         ->where('beersorts.group_id', '=', $group_id)
                         ->whereRaw('ISNULL (beersorts.deleted_at)')
                         ->get();
       

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

        $ingr = Recept::where('biersoort_id', $biersrt)->get();

        DB::beginTransaction();
        foreach ($ingr as $key => $value) {

            $grondstof = $value->grondstof_id;
            $aantalkilo = $value->hoeveelheid * $ltrs;
            
            $grondstofnaam = Grondstof::select('naam')->where('id', $grondstof)->first();
            
            $avail = $this->verbruik($grondstof, $aantalkilo);
            
            if( $avail['code'] <> 200 ){
                $warning = true;
                $warninggrondstoffen[] = '<br>Tekort aan grondstof ' . $grondstofnaam->naam . ' (' . $aantalkilo . ' kg)';
            };
        }

        if ($warning){
            
            Log::info('Warning issued, rollback transaction');
            DB::rollBack();
            
            return Response::json(array('message' => 'ERROR',
                                        'code' => 6666,
                                        'details' => $warninggrondstoffen
                                        )
                                    );
        }else{
            
            Log::info('No warning issued, commit transaction');
            $group_id = Auth::user()->group->id;
            $request['group_id'] = $group_id;

            $brouwsel = Brouwsel::create($request->all());
            DB::commit();

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

        $totaal_beschikbaar = DB::select(DB::raw('
                                            SELECT SUM(hoeveelheidkg - verbruiktkg) AS totaalbeschikbaar
                                            FROM inkoopgrondstof 
                                            WHERE isnull(deleted_at)
                                            AND grondstof_id = :grondstof
                                        '), array('grondstof' => $grondstof)
                                    );

        
        $beschikbare_kg_grondstof = $totaal_beschikbaar[0]->totaalbeschikbaar;
        Log::info('Totaal beschikbare kg grondstof ' . $grstf_naam . ' = kg ' . $beschikbare_kg_grondstof);
        Log::info('Benodigd aant kg grondstof ' . $aantkg);

        if ($beschikbare_kg_grondstof >= $aantkg){
            //Er is met zekerheid voldoende aanwezig van deze huidige grondstof

            //Loop through beschikbare grondstoffen, schrijf af en zoek door als nog niet voldoende bereikt  
            $te_vinden_kg = $aantkg;
            $totnutoe_gevondenkg = 0;
            $resteert_te_vinden = 0;

            $beschikbaar = DB::select(DB::raw(' SELECT id, grondstof_id, hoeveelheidkg, verbruiktkg 
                                                FROM inkoopgrondstof 
                                                WHERE isnull(deleted_at)
                                                AND grondstof_id = :grondstof
                                                AND (hoeveelheidkg - verbruiktkg) > 0 '), 
                                        array('grondstof' => $grondstof) //for prepared statement
                                        );
            
            foreach($beschikbaar as $key => $value){

                if(($value->hoeveelheidkg - $value->verbruiktkg) >= $te_vinden_kg){
                    //Voldoende hoeveelheid gevonden. schrijf hoeveelheid af en stop met zoeken                    
                    Log::info('Gevonden grondstofid: ' . $value->grondstof_id);

                    $totnutoe_gevondenkg = $te_vinden_kg;
                    $updte = Inkoopgrondstof::find($value->id);
                    $updte->verbruiktkg = $value->verbruiktkg + $aantkg;
                    $updte->save();
                    
                    $resteert_te_vinden = 0;

                    break 1; //Exit foreach 1 level

                }elseif(($value->hoeveelheidkg - $value->verbruiktkg) < $te_vinden_kg){
                    //NIET voldoende grondstof in deze inkoop, schrijf BESCHIKBARE hoeveelheid af en zoek door

                    $updte = Inkoopgrondstof::find($value->id);
                    
                    $gevonden = $value->hoeveelheidkg - $value->verbruiktkg;
                    $totnutoe_gevondenkg = $totnutoe_gevondenkg + $gevonden;
                    $resteert_te_vinden = $resteert_te_vinden - $gevonden;

                    $updte->verbruiktkg = $updte->verbruiktkg + $gevonden;
                    $updte->save();

                    if ($gevonden >= $aantkg){
                        break 1;
                    }
                }
            }

            Log::info('Grondstof geheel beschikbaar: ' . $grondstof . ' (' . $aantkg . ' kg)');            
            
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
