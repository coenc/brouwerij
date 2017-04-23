<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Leverancier;
use App\Group;
use Illuminate\Support\Facades\DB;
use Response;
use Log;
use Carbon\Carbon;

class LeverancierController extends Controller
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
        $leveranciers = Leverancier::all()->sortBy('naam');
        return view('leveranciers.index')->with('leveranciers', $leveranciers);
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

        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['naam'] = $request->naam;
        $userinput['factuurnaam'] = $request->factuurnaam;
        $userinput['factuuradres'] = $request->factuuradres;
        $userinput['factuurpostcode'] = $request->factuurpostcode;
        $userinput['factuurplaats'] = $request->factuurplaats;
        $userinput['contactpersoon'] = $request->contactpersoon;
        $userinput['telefoon'] = $request->telefoon;
        $userinput['mobiel'] = $request->mobiel;
        $userinput['email'] = $request->email;
        $userinput['website'] = $request->website;
        $userinput['bankrekening'] = $request->bankrekening;
        $userinput['banknaam'] = $request->banknaam;
        $userinput['group_id'] = $group_id;

        $lev = Leverancier::create($userinput);
        return Response::json($lev);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leverancier = Leverancier::find($id);
        return Response::json($leverancier);
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
    public function update(Request $request, $leverancier_id)
    {
        
        Log::info('REQUEST:::::::');
        log::info($request->all());

        $leverancier = Leverancier::find($leverancier_id);
        

        $leverancier->naam = $request->naam;
        $leverancier->factuurnaam = $request->factuurnaam;
        $leverancier->factuuradres = $request->factuuradres;
        $leverancier->factuurpostcode = $request->factuurpostcode;
        $leverancier->factuurplaats = $request->factuurplaats;
        $leverancier->contactpersoon = $request->contactpersoon;
        $leverancier->telefoon = $request->telefoon;
        $leverancier->mobiel = $request->mobiel;
        $leverancier->email = $request->email;
        $leverancier->website = $request->website;
        $leverancier->bankrekening = $request->bankrekening;
        $leverancier->banknaam = $request->banknaam;
        
        $leverancier->save();

        return Response::json($leverancier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leverancier = Leverancier::destroy($id);
        return Response::json($leverancier);
    }

    public function brief(Request $request)
    {

        $group_id = Auth::user()->group->id;

        $group = Group::find($group_id);
        
        $leverancier = Leverancier::find($request['lev']);

        return view('leveranciers.brief')->with('leverancier', $leverancier)
                                         ->with('group', $group);

    }
    
}
