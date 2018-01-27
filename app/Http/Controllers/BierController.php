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
use File;
use Image;
use Purifier;
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
    public function index(Request $request, $productcat = NULL)
    {

        $group_id = Auth::user()->group->id;

        // $productcategory = $request['cat'];

        if(isset($productcat)){
            $biersrtn = Beersort::ofCategory($productcat)->get()->sortBy('omschrijving');
        }else{
            $biersrtn = Beersort::all()->sortBy('omschrijving');
        }

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
            $tarifs[$accijnstarief->id] = $accijnstarief->percentageplato;
        }

        //Build array for dropdown vast/seizoen
        $vastofseizoen_dropdown = array();
        $vastofseizoen_dropdown['V'] = 'Vast';
        $vastofseizoen_dropdown['S'] = 'Seizoen';

        $maxfilesize = ini_get("upload_max_filesize");

        return view('biersoorten.index')->with('biersoorten', $biersrtn)
                                            ->with('group_id', $group_id)
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

        $group_id = Auth::user()->group->id;

        //Validate input
        $validator = Validator::make($request->all(), [
            // 'code' => 'required|max:3',
            // 'omschrijving' => 'required|min:3',
        ]);
        
        // //Show validation errors.
        // if ($validator->fails()) {
        //       return redirect('/biersoorten')
        //       ->withInput()
        //       ->withErrors($validator);
        // }

        //Get user input from $request object
        $userinput = array();
        $userinput['biersoort_id'] = $request->biersoort_id;
        $userinput['code'] = $request->code;
        $userinput['omschrijving'] = $request->omschrijving;
        $userinput['toelichting'] = $request->toelichting;
        $userinput['beercategory_id'] = $request->beercategory_id;
        $userinput['accijnstarif_id'] = $request->accijnstarif_id;
        $userinput['vastofseizoen'] = $request->vastofseizoen;
        $userinput['fgmin'] = $request->fgmin ? $request->fgmin : 0;
        $userinput['fgmax'] = $request->fgmin ? $request->fgmax : 0;
        $userinput['ogmin'] = $request->ogmin ? $request->ogmin : 0;
        $userinput['ogmax'] = $request->ogmax ? $request->ogmax : 0;
        $userinput['alcvolmin'] = $request->alcvolmin ? $request->alcvolmin : 0;
        $userinput['alcvolmax'] = $request->alcvolmax ? $request->alcvolmax : 0;
        $userinput['ebumin'] = $request->ebumin ? $request->ebumin : 0;
        $userinput['ebumax'] = $request->ebumax ? $request->ebumax : 0;
        $userinput['ebcmin'] = $request->ebcmin ? $request->ebcmin : 0;
        $userinput['ebcmax'] = $request->ebcmax ? $request->ebcmax : 0;
        $userinput['group_id'] = $group_id;

        //Save beersort data 
        $bier = Beersort::create($userinput);
        $nw_id = $bier->id;
        
        $this->handleImageFile($nw_id);
        
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
        
        //////////////////////////////////////////////////////////////////////////////////////
        // Proces $_PUT data:                                                               //
        // http://stackoverflow.com/questions/9464935/php-multipart-form-data-put-request   //
        //////////////////////////////////////////////////////////////////////////////////////
        
        // Fetch content and determine boundary
        $raw_data = file_get_contents('php://input');
        $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));

        // Fetch each part
        $parts = array_slice(explode($boundary, $raw_data), 1);
        $data = array();

        foreach ($parts as $part) {
            // If this is the last part, break
            if ($part == "--\r\n") break; 

            // Separate content from headers
            $part = ltrim($part, "\r\n");
            list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);

            // Parse the headers list
            $raw_headers = explode("\r\n", $raw_headers);
            $headers = array();
            foreach ($raw_headers as $header) {
                list($name, $value) = explode(':', $header);
                $headers[strtolower($name)] = ltrim($value, ' '); 
            }

            // Parse the Content-Disposition to get the field name, etc.
            if (isset($headers['content-disposition'])) {
                $filename = null;
                preg_match(
                    '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/', 
                    $headers['content-disposition'], 
                    $matches
                );
                list(, $type, $name) = $matches;
                isset($matches[4]) and $filename = $matches[4]; 

                // handle your fields here
                switch ($name) {
                    // this is a file upload
                    case 'userfile':
                        console.log('Bestandje: ' + $filename);
                        file_put_contents($filename, $body);
                        break;
                    // default for all other files is to populate $data
                    default: 
                        $data[$name] = substr($body, 0, strlen($body) - 2);
                        break;
                } 
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////

        $bier = Beersort::find($bier_id);
        
        $bier['code'] = $data['code'];
        $bier['omschrijving'] = $data['omschrijving'];
        $bier['toelichting'] = $data['toelichting'];
        $bier['beercategory_id'] = $data['beercategory_id'] ? $data['beercategory_id'] : 0;
        $bier['accijnstarif_id'] = $data['accijnstarif_id'] ? $data['accijnstarif_id'] : 0;
        $bier['vastofseizoen'] = $data['vastofseizoen'] ? $data['vastofseizoen'] : 0;
        $bier['fgmin'] = $data['fgmin'] ? $data['fgmin'] : 0;
        $bier['fgmax'] = $data['fgmin'] ? $data['fgmax'] : 0;
        $bier['ogmin'] = $data['ogmin'] ? $data['ogmin'] : 0;
        $bier['ogmax'] = $data['ogmax'] ? $data['ogmax'] : 0;
        $bier['alcvolmin'] = $data['alcvolmin'] ? $data['alcvolmin'] : 0;
        $bier['alcvolmax'] = $data['alcvolmax'] ? $data['alcvolmax'] : 0;
        $bier['ebumin'] = $data['ebumin'] ? $data['ebumin'] : 0;
        $bier['ebumax'] = $data['ebumax'] ? $data['ebumax'] : 0;
        $bier['ebcmin'] = $data['ebcmin'] ? $data['ebcmin'] : 0;
        $bier['ebcmax'] = $data['ebcmax'] ? $data['ebcmax'] : 0;

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
        
        $group_id = Auth::user()->group->id;

        $bier = Beersort::find($bier_id);
        
        //Remove image file        
        if($bier->image){
            $filename = '/images/biersoorten/' . $group_id . '/' . $bier->image;
            Storage::delete($filename);
        }

        $bier = Beersort::destroy($bier_id);
 
        return Response::json($bier);

    }

    private function handleImageFile($nw_id){
        
        $group_id = Auth::user()->group->id;
        $new_file_name = "";

        //Save file (if any)
        if(isset($_FILES["image"]["type"]))
        {

            $validextensions = array("jpeg", "jpg", "png", "bmp", "gif");
            $temporary = explode(".", $_FILES["image"]["name"]);
            $file_extension = end($temporary);
            
            if ((($_FILES["image"]["type"] == "image/png") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/jpeg")
            ) && ($_FILES["image"]["size"] < 10000000) //Filesize max 10000kb/10Mb
            && in_array($file_extension, $validextensions)) 
            {
                if ($_FILES["image"]["error"] > 0)
                {
                    // echo "Return Code: " . $_FILES["image"]["error"] . "<br/><br/>";
                }
                else
                {
                    //Move file
                    $dir = public_path() . "/images/biersoorten/" . $group_id;

                    $sourcePath = $_FILES['image']['tmp_name'];
                    $targetPath = $dir . '/' . $nw_id . '.' . $file_extension;

                    //Check if dir exists
                    $result = File::makeDirectory($dir, 0775, true, true);

                    move_uploaded_file($sourcePath, $targetPath);

                    $new_file_name = $nw_id . '.' . $file_extension;

                }
            }
            else
            {
                Log::info('Image filetype incorrect or size too big');
                Log::info('File type incorrect or file too big...');
            }
        }
        else
        {
            Log::info('File not set...');
            $new_file_name = 'nologo.gif';
        }

        //Write filename to DB
        $x = Beersort::find($nw_id);
        $x->image = $new_file_name;
        $x->save();

    }
}
