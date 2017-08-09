<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\User;
use App\Book;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $user = User::where('name',$username)->first();
        $user_Books = Book::orderBy('id','DESC')->where('user_id',$user->id)->paginate(15);
        $notes = Note::orderBy('id','DESC')->where('user_id',$user->id)->paginate(6);
        return view('home',compact('notes','user_Books'));
    }

}
