<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $phpversion = phpversion();
        $appversion = config('app.version');
        $email = "info@bis.com";

        if (Auth::check())
        {
            // The user is logged in...
            $id = Auth::user()->id;
            $currentuser = User::find($id);
            if($currentuser->group_id){
                $grouplogo = $currentuser->group->logo;
                $groupname = $currentuser->group->groupname;
            }
            else
            {
                $grouplogo = 'nologo.gif';
                $groupname = 'New company';       
            }
        }
        else
        {
            $grouplogo = 'nologo.gif';
            $groupname = 'New company';
        }

        return view('index')->with('phpversion', $phpversion)
                            ->with('appversion', $appversion)
                            ->with('email', $email)
                            ->with('groupname', $groupname)
                            ->with('grouplogo', $grouplogo);
                            // ->with('fakerdata', $fakerdata);
    }
}
