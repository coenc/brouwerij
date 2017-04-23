<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Log;
use App\Visitordata;

class VisitordataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $visitor = new Visitordata;
        $visitor->ipaddress = $request->ip();
        $visitor->requestedurl = $request->url();
        $visitor->useragent = $request->server('HTTP_USER_AGENT');

        echo($request->ip() . ' ' . $request->server('HTTP_USER_AGENT')) ;

        $visitor->save();

        return view('welcome');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function getVisitorData(Request $request){

    //     $visitor = new Visitordata;

    //     $visitor->ipaddress = $request->ip;

    //     echo($request);

    //     $visitor->save();


    // }
}
