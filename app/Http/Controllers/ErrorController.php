<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //

    public function showError(){
        return view('errors.404');
    }
}
