<?php

namespace App\Http\Controllers;
use App\Mail\StudentAccessNotification;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        // You can pass data to the view if necessary
        return view('admin.dashboard');
    }
   

    

 
}     