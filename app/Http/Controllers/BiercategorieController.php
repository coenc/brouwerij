<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Beercategory;
use Validator;
// Use Illuminate\Contracts\Validation\Validator;
use Response;
Use Log;


class BiercategorieController extends Controller
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
        $biercategorieen = Beercategory::all()->sortBy('omschrijving');

        return view('biercategorieen.index')->with('biercats', $biercategorieen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        if ($validator->fails()) {
            // return redirect('/productcategorieen')
            //             ->withErrors($validator)
            //             ->withInput();
            return redirect()->back()->withErrors($validator);
        }

        $group_id = Auth::user()->group->id;

        $userinput = array();
        $userinput['omschrijving'] = $request->omschrijving;
        $userinput['group_id'] = $group_id;

        $biercat = Beercategory::create($userinput);

        // return('Create new beercat with ID ' . $biercat->id);    
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
        $biercat = Beercategory::find($id);
        return Response::json($biercat);
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
    public function update(Request $request, $id)
    {
        // $data = $request->input();
        log::info('Hier staat het');
        log::info($request->input('omschrijving')); ///NIKS!!!!!
        log::info('ALL:');
        log::info($request->all());

        $userinput = array();
        $userinput['omschrijving'] = $request->omschrijving;
        log::info($request->omschrijving); ///WEER NIKS????

        $biercat = Beercategory::find($id);
        $biercat->omschrijving = $request->input('omschrijving');
        $biercat->save();

        return Response::json($biercat);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biercat = Beercategory::find($id);
        $biercat = Beercategory::destroy($id);
        return Response::json($biercat);
    }
}
