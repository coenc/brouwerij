<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Beercategory;
use Validator;
use Response;
use Log;


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
        
        $group_id = Auth::user()->group->id;

        //Validate input
        $validator = Validator::make($request->all(), [
            'omschrijving' => 'required',
        ]);

        if ($validator->fails()) {
            
            // return redirect('/productcategorieen')
            //             ->withErrors($validator)
            //             ->withInput();
            
            //return redirect()->back()->withErrors($validator);
        }
        
        $userinput = array();
        $userinput['omschrijving'] = $request->omschrijving;
        $userinput['group_id'] = $group_id;

        $biercat = Beercategory::create($userinput);

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

        // log::info('Te verwijderen recepten:');
        // log::info(  json_encode($biercat->recepten() ) );
        // foreach ($biercat->recepten as $rcpt) {
        //     echo $rcpt->id;
        // }

        //Delete beersorts for this catgeory
        $biercat->beersorts()->delete();
        //Delete this beercategory
        $biercat = Beercategory::destroy($id);
        
        return Response::json($biercat);

    }
}
