<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class PublishesController extends Controller
{
    public function showNew(){

        return view('foreign.published');
    }

}
