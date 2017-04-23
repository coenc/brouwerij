<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Grondstofcategorie;
use App\Grondstof;
use Validator;
use Response;
Use Log;

class GrondstofcategorieController extends Controller
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
        $grondstofcats = Grondstofcategorie::all()->sortBy('id');
        return view('grondstofcategorieen.index')->with('grondstofcats', $grondstofcats);
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
            'omschrijving' => 'required',
        ]);

        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['omschrijving'] = $request->omschrijving;
        $userinput['group_id'] = $group_id;
        $biercat = Grondstofcategorie::create($userinput);

        return Response::json($biercat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grondstofcat = Grondstofcategorie::find($id);
        
        return Response::json($grondstofcat);
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
    public function update(Request $request, $grstcat_id)
    {
        $grondstofcat = Grondstofcategorie::find($grstcat_id);
        
        $grondstofcat->omschrijving = $request->omschrijving;
        
        $grondstofcat->save();

        return Response::json($grondstofcat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $grondstofcat = Grondstofcategorie::find($id);

        //Delete grondstoffen for this grondstofcategorie
        $grondstofcat->grondstoffen()->delete();

        //Delete grondstofcategorie
        $grondstofcat->delete();        

        return Response::json($grondstofcat);
    }
}
