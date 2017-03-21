<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Grondstof;
use App\Inkoopgrondstof;
use Validator;
use Response;
Use Log;

class InkoopController extends Controller
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
        $grondstoffen = Grondstof::all()->sortBy('naam');
        $inkoopgrondstoffen = Inkoopgrondstof::all()->sortByDesc('datum');

        //Build array for dropdown biersoort 
        $grondstof_dropdown = array();
        foreach ($grondstoffen as $grondstof) {
             $grondstof_dropdown[$grondstof->id] = $grondstof->naam; 
        }

        return view('inkopen.index')->with('inkoopgrondstoffen', $inkoopgrondstoffen)
                                    ->with('grondstoffen', $grondstoffen)
                                    ->with('grondstof_dropdown', $grondstof_dropdown );
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
            'datum' => 'required',
        ]);

        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['datum'] = $request->datum;
        $userinput['grondstof_id'] = $request->grondstof_id;
        $userinput['hoeveelheidkg'] = $request->hoeveelheidkg;
        $userinput['prijsexbtw'] = $request->prijsexbtw;
        $userinput['group_id'] = $group_id;

        $inkoop = Inkoopgrondstof::create($userinput);
        
        return Response::json($inkoop);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inkoop = Inkoopgrondstof::find($id);
        return Response::json($inkoop);
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
    public function update(Request $request, $inkoop_id)
    {
        $inkoop = Inkoopgrondstof::find($inkoop_id);
        
        $inkoop->datum = $request->datum;
        $inkoop->grondstof_id = $request->grondstof_id;
        $inkoop->hoeveelheidkg = $request->hoeveelheidkg;
        $inkoop->prijsexbtw = round($request->prijsexbtw, 3);
        
        $inkoop->save();

        return Response::json($inkoop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($inkoop_id)
    {
        $inkoop = Inkoopgrondstof::destroy($inkoop_id);
        return Response::json($inkoop);

    }
}
