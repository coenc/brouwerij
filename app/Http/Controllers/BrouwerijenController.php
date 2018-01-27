<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brouwerij;
use Response;
use Log;

class BrouwerijenController extends Controller
{
	public function index()
    {
        return view('brouwerijen.index')->with('brouwerijen');   
    }

    public function brouwerijen()
    {
    	$brouwerijen = Brouwerij::inRandomOrder()->limit(10)->get();
        // $brouwerijen = Brouwerij::get();
        
        foreach ($brouwerijen as $key => $value) {
            // log::info('testin123:' + $brouwerijen['adres']);
            log::info(print_r( $brouwerijen, 1));
            // phpgeocode($brouwerijen->adres);
        }

    	return Response::json($brouwerijen);
    }


    public function phpgeocode($address){

        ///////////////////////////////////////////////
        // PHP code for geocoding
        ///////////////////////////////////////////////

        // url encode the address
        $address = urlencode($address);
         
        // google map geocode api url
        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
     
        // get the json response
        $resp_json = file_get_contents($url);
         
        // decode the json
        $resp = json_decode($resp_json, true);
     
        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
     
            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];
             
            // verify if data is complete
            if($lati && $longi && $formatted_address){
             
                // put the data in the array
                $data_arr = array();            
                 
                array_push(
                    $data_arr, 
                        $lati, 
                        $longi, 
                        $formatted_address
                    );
                 
                return $data_arr;
                 
            }else{
                return false;
            }
             
        }else{
            return false;
        }
    }



    public function update_lat_lon($pId, $pLat, $pLon)
    {
        $updated_lat_lon = $pId . $pLat . $pLon;
        log::info('Updated lat/lon:');
    }


}
