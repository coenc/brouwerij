<?php

namespace App\Http\Controllers;

use App\Beersort;
use App\Beercategory;
use App\Accijnstarif;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Http\Request;
use Response;
Use Log;
use Validator;
use Vendor\Intervention\image\Image;
//use vendor\ezyang\htmlpurifier\HTMLPurifier;
use Illuminate\Support\Facades\Storage;

class BierController extends Controller
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
        // $biersrtn = Beersort::where('group_id', $group_id)->get()->sortBy('omschrijving');
        $biersrtn = Beersort::all()->sortBy('omschrijving');
        // $biercategorieen = Beercategory::where('group_id', $group_id)->get()->sortBy('omschrijving');
        $biercategorieen = Beercategory::all()->sortBy('omschrijving');
        $accijnstarieven = Accijnstarif::all();

        //Build array for dropdown categorie
        $beercats = array();
        foreach ($biercategorieen as $biercategorie) {
            $beercats[$biercategorie->id] = $biercategorie->omschrijving; 
        }

        //Build array for dropdown accijnstarief        
        $tarifs = array();
        foreach ($accijnstarieven as $accijnstarief) {
            // $tarifs[$accijnstarief->id] = '€ ' . $accijnstarief->tariefperhl;
            $tarifs[$accijnstarief->id] = $accijnstarief->percentageplato;
        }

        $vastofseizoen_dropdown = array();
        $vastofseizoen_dropdown['V'] = 'Vast';
        $vastofseizoen_dropdown['S'] = 'Seizoen';

        $maxfilesize = ini_get("upload_max_filesize");

        return view('biersoorten.index')->with('biersoorten', $biersrtn)
                                            ->with('biercategorieen', $beercats)
                                            ->with('maxfilesize', $maxfilesize)
                                            ->with('vastofseizoen_dropdown', $vastofseizoen_dropdown)
                                            ->with('accijnstarieven', $tarifs);
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
        Log::info($request->all());

        //Validate input
        // $validator = Validator::make($request->all(), [
        //     'code' => 'required|max:3',
        //     'omschrijving' => 'required|min:3',
        // ]);
        
        // //Show validation errors. WERKT NOG NIET BIJ MODAL(!) INPUT SCREEN!!!!!
        // if ($validator->fails()) {
        //       return redirect('/biersoorten')
        //       ->withInput()
        //       ->withErrors($validator);
        // }

        $data = array();

        if(isset($_GET['files']))
        {  
            Log::info('var files is set.');
            $error = false;
            $files = array();

            $uploaddir = base_path() . '/public/images/biersoorten/';
            $dest_filename = $request->omschrijving;
            foreach($_FILES as $file)
            {
                if(move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name'])))
                {
                    $files[] = $uploaddir . $file['name'];
                }
                else
                {
                    $error = true;
                }
            }
            $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
        }
        else
        {
            $data = array('success' => 'File form was submitted', 'formData' => $_POST);
        }

        Log::info($data);







        //Get user input from $request object
        $userinput = array();
        $userinput['biersoort_id'] = $request->biersoort_id;
        $userinput['code'] = $request->code;
        $userinput['omschrijving'] = $request->omschrijving;
        $userinput['toelichting'] = $request->toelichting;
        $userinput['beercategory_id'] = $request->beercategory_id;
        $userinput['accijnstarif_id'] = $request->accijnstarif_id;
        $userinput['vastofseizoen'] = $request->vastofseizoen;
        $userinput['fgmin'] = $request->has('fgmin') ? $request->input('fgmin') : NULL;
        $userinput['fgmax'] = $request->has('fgmax') ? $request->input('fgmax') : NULL;
        $userinput['ogmin'] = $request->has('ogmin') ? $request->input('ogmin') : NULL;
        $userinput['ogmax'] = $request->has('ogmax') ? $request->input('ogmax') : NULL;
        $userinput['alcvolmin'] = $request->has('alcvolmin') ? $request->input('alcvolmin') : NULL;
        $userinput['alcvolmax'] = $request->has('alcvolmax') ? $request->input('alcvolmax') : NULL;
        $userinput['ebumin'] = $request->has('ebumin') ? $request->input('ebumin') : NULL;
        $userinput['ebumax'] = $request->has('ebumax') ? $request->input('ebumax') : NULL;
        $userinput['ebcmin'] = $request->has('ebcmin') ? $request->input('ebcmin') : NULL;
        $userinput['ebcmax'] = $request->has('ebcmax') ? $request->input('ebcmax') : NULL;

        // Check for uploaded image object
        if ($request->image){
            if ($request->image->isValid()){

                // Log::info('File selected:');
                // Log::info($request->image->getClientOriginalName());
                // Log::info($request->image->getClientOriginalExtension());
                // Log::info($request->image->getPathname());
                // Log::info($request->image->getBasename());
                // Log::info($request->image->getPathInfo());
                // Log::info($request->image->getRealPath());
                // Log::info($request->image->getSize());
                // Log::info($request->image->getMimeType());
                
                //Save tmp file
                $destinationPath = base_path() . '/public/images/biersoorten/';
                $destinationFilename = ($request->omschrijving == '' ? $request->code : $request->omschrijving). '.' . $request->image->getClientOriginalExtension();
                $userinput['image'] = $destinationFilename;
                $request->file('image')->move($destinationPath , $destinationFilename);
            }else{
                Log::info('Not a valid beersort image file');
            }
        }else{
            Log::info('No beersort file selected');
        }

        //Log::info('User input: ' . print_r($userinput, 1));
        
        $userinput['group_id'] = Auth::user()->group->id;
        $bier = Beersort::create($userinput);

        return Response::json($bier);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bier_id)
    {
        $bier = Beersort::find($bier_id);
        return Response::json($bier);
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
    public function update(Request $request, $bier_id)
    {
        $bier = Beersort::find($bier_id);
        
        $bier->code = $request->code;
        $bier->omschrijving = $request->omschrijving;
        $bier->toelichting = $request->toelichting;
        $bier->beercategory_id = $request->beercategory_id;
        $bier->accijnstarif_id = $request->accijnstarif_id;
        $bier->vastofseizoen = $request->vastofseizoen;
        $bier->fgmin = $request->has('fgmin') ? $request->input('fgmin') : NULL;
        $bier->fgmax = $request->has('fgmax') ? $request->input('fgmax') : NULL;
        $bier->ogmin = $request->has('ogmin') ? $request->input('ogmin') : NULL;
        $bier->ogmax = $request->has('ogmax') ? $request->input('ogmax') : NULL;
        $bier->alcvolmin = $request->has('alcvolmin') ? $request->input('alcvolmin') : NULL;
        $bier->alcvolmax = $request->has('alcvolmax') ? $request->input('alcvolmax') : NULL;
        $bier->ebumin = $request->has('ebumin') ? $request->input('ebumin') : NULL;
        $bier->ebumax = $request->has('ebumax') ? $request->input('ebumax') : NULL;
        $bier->ebcmin = $request->has('ebcmin') ? $request->input('ebcmin') : NULL;
        $bier->ebcmax = $request->has('ebcmax') ? $request->input('ebcmax') : NULL;
        // $bier->image = ......TODO

        $bier->save();

        return Response::json($bier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bier_id)
    {
        //Remove image file
        $bier = Beersort::find($bier_id);
        
        if($bier->image){
            $filename = '/images/biersoorten/' . $bier->image;
            Log::info('Deleting file '.$filename);
            Storage::delete($filename);
        }

        $bier = Beersort::destroy($bier_id);
        return Response::json($bier);
    }
}
