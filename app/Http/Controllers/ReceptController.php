<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use Response;
Use App\Recept;
Use App\Beersort;
use App\Grondstof;
use Illuminate\Support\Facades\DB;
use Validator;

class ReceptController extends Controller
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
        
        $recepten = Recept::all();
        
        $bier_dropdown = DB::table('beersorts')
                        ->select(DB::raw('id, code, omschrijving'))
                        ->whereRaw('ISNULL (deleted_at)')
                        ->where('group_id', '=' , $group_id)
                        ->get()
                        ->sortBy('omschrijving');
        
        //Build array for dropdown grondstoffen
        $grondstoffen = Grondstof::all()->sortBy('naam');
        $grndstf_dropdown = array();
        foreach ($grondstoffen as $grondstof) {
            $grndstf_dropdown[$grondstof->id] = $grondstof->naam; 
        }
        
        return view('recepten.index')->with('bierdropdown', $bier_dropdown)
                                    ->with('grondstofdropdown', $grndstf_dropdown)
                                    ->with('recepten', $recepten);
    }

    public function recept(Request $request)
    {
        $filter = $request->input('biersoort_id');
        
        $recept = DB::table('recepten')
                        ->join('grondstoffen', 'recepten.grondstof_id', '=', 'grondstoffen.id')
                        ->select('recepten.id', 'naam', 'hoeveelheid')
                        ->where('biersoort_id', '=', $filter )
                        ->get();

        return json_encode($recept);
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
            'group_id' => 'required',
            'biersoort_id' => 'required',
            'grondstof_id' => 'required',
            'hoeveelheid' => 'required',
        ]);

        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['group_id'] = $group_id;
        $userinput['biersoort_id'] = $request->biersoort_id;
        $userinput['grondstof_id'] = $request->grondstof_id;
        $userinput['hoeveelheid'] = $request->hoeveelheid;

        $receptregel = Recept::create($userinput);

        return Response::json($receptregel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recept = Recept::find($id);
        return Response::json($recept);
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
    public function update(Request $request, $recept_id)
    {
        $userinput = array();
        $userinput['grondstof_id'] = $request->grondstof_id;
        $userinput['hoeveelheid'] = $request->hoeveelheid;
        
        $recept = Recept::find($recept_id);
        
        $recept->grondstof_id = $request->input('grondstof_id');
        $recept->hoeveelheid = $request->input('hoeveelheid');

        $recept->save();

        return Response::json($recept);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($receptregel_id)
    {
        $recept_regel = Recept::destroy($receptregel_id);
        
        return Response::json($recept_regel);
    }
}
