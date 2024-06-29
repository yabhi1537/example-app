<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
     public function index()
    {
        return view('student.index');
    }
 public function logouts()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }

   
}