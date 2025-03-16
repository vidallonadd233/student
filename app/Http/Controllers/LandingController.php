<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class LandingController extends Controller
{


    public function Home(){


        return view('landing.home');
    }


    public function About(){
        return view('landing.about');
    }



    public function contact() {
        return view('landing.contact');
    }



}
