<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use App\Group;
use Validator;
use Response;
use Session;
use Image;

class ProfielController extends Controller
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

        $group = Group::find($group_id);
        
        return view('user.profiel')->with('group', $group);
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
            'groupname' => 'required',
        ]);

        $group_id = Auth::user()->group->id;
        
        $groep = Group::find($group_id);
        $groep->groupname = $request->groupname;
        $groep->adres = $request->adres;
        $groep->postcode = $request->postcode;
        $groep->woonplaats = $request->woonplaats;
        $groep->email = $request->email;

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $group_id . '.' . $file->getClientOriginalExtension();
            $filepath = 'images/logos/' . $filename;
            //Resize and watermark uploaded image, keep aspect ratio
            Image::make($file)->resize(300, null, function ($constraint) 
                                {$constraint->aspectRatio();})
                                ->insert('images/logos/watermark.gif', 'bottom-right', 5, 5)
                                ->save($filepath);
            
            $groep->logo = $filename;
            
        }

        if($groep->save()){
            Session::flash('success', 'Profiel opgeslagen:');
        }

        return redirect('/mijnprofiel');
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
}
