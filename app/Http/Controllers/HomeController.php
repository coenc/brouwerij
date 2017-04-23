<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
use App\Visitordata;
use Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $phpversion = phpversion();
        $apacheversion = $_SERVER['SERVER_SOFTWARE'];
        $appversion = config('app.version');
        $email = "info@bis.com";

        //Save visitors data
        $visitor = new Visitordata;
        $visitor->ipaddress = $request->ip();
        $visitor->requestedurl = $request->url();
        $visitor->useragent = $request->server('HTTP_USER_AGENT');
        $visitor->save();

        if (Auth::check())
        {
            $id = Auth::user()->id;
            $currentuser = User::find($id);
            if($currentuser->group_id){
                $grouplogo = $currentuser->group->logo;
                $groupname = $currentuser->group->groupname;
            }
        }
        else
        {
            $grouplogo = 'nologo.gif';
            $groupname = 'New company';
        }

        return view('index')->with('phpversion', $phpversion)
                            ->with('appversion', $appversion)
                            ->with('apacheversion', $apacheversion)
                            ->with('email', $email)
                            ->with('groupname', $groupname)
                            ->with('grouplogo', $grouplogo);
    }
}
