<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class ProfilesController extends Controller
{
    public function index($username)
    {

    	$crumbs = 
    	[
    		"Forums" => "",
    		"Profile : ".$username => "profile/".$username,
    		// $username => $username
    	];

    	if(Auth::guest())
    	{
    		Session::flash('alert', 'You need to login to view profiles');
    		return redirect('login');
    	}
    	else
    	{
    		return view('profile', compact('username', 'crumbs'));
    	}
    }
}
