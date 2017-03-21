<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Grondstof;
use App\Grondstofcategorie;
use Validator;
use Response;
Use Log;

class GrondstofController extends Controller
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
        $grondstoffen = Grondstof::all()->sortBy('grondstofcategorie_id');
        $grondstoffencategories = Grondstofcategorie::all()->sortBy('omschrijving');

        // echo(print_r($grondstoffen, 1));
        // echo(print_r($grondstoffencategories, 1));
        // die;

        //Build array for dropdown biersoort 
        $grondstofcat_dropdown = array();
        foreach ($grondstoffencategories as $grondstoffencategory) {
             $grondstofcat_dropdown[$grondstoffencategory->id] = $grondstoffencategory->omschrijving; 
        }

        return view('grondstoffen.index')->with('grondstoffen', $grondstoffen)
                                            ->with('grondstofcategorieen', $grondstoffencategories)
                                            ->with('grondstofcat_dropdown', $grondstofcat_dropdown);
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
        //Validate input
        $validator = Validator::make($request->all(), [
            'naam' => 'required',
        ]);
        
        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['group_id'] = $group_id;
        $userinput['naam'] = $request->naam;
        $userinput['grondstofcategorie_id'] = $request->grondstofcategorie_id;

        Log::info('<*userinput*');
        Log::info(print_r($userinput, 1));
        Log::info('***>');

        // $grondstof = Grondstof::create($request->all()); //Hier gaat het fout!!!!!!!!!!!!!!!!! Waardes worden niet ge-insert!!!!!!!!!!!!!!        
        $grondstof = Grondstof::create($userinput); //TODO : Hier gaat het fout!!!!!!!!!!!!!!!!! Waardes worden niet ge-insert!!!!!!!!!!!!!!

        Log::info('<+result+');
        Log::info($grondstof);
        Log::info('+++>');

        return Response::json($grondstof);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grondstof = Grondstof::find($id);
        return Response::json($grondstof);
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
    public function update(Request $request, $grondstof_id)
    {
        $grondstof = Grondstof::find($grondstof_id);
        
        $grondstof->naam = $request->naam;
        $grondstof->grondstofcategorie_id = $request->grondstofcategorie_id;
        
        $grondstof->save();

        return Response::json($grondstof);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($grondstof_id)
    {
        
        $grondstof = Grondstof::destroy($grondstof_id);
        return Response::json($grondstof);
    }
}
