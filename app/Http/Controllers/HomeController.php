<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\User;
use App\Book;
use Session;
use Auth;

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

    public function showProfile($username){
        $user = User::where('name',$username)->first();
        return view('profile.profile',compact('user'));

    }

    public function changeProfilePicture(Request $request){
        $user = User::find(Auth::user()->id);
        $ext = $request->user_pic->getClientOriginalExtension();
        if($request->hasFile('user_pic')){
            if( $ext =='jpg' || $ext = 'JPG' || $ext =='jpeg' || $ext =='JPEG' || $ext =='png' || $ext =='PNG' || $ext =='gif' || $ext =='GIF' || $ext =='bmp' || $ext =='BMP'){
                $fileName = uniqid().'.'.$ext;
                if($request->user_pic->move('userimages',$fileName)){
                    if($user->update(['profile_picture'=>'userimages/'.$fileName])){
                        return redirect()->route('home',Auth::user()->name);
                    }
                }
            }else{
                return back()->with('Notice','The item you selected is not an image. It is a '.$ext.' file, please select an image.');
            }
        }else{
            return back()->with('Notice','you did not select any image. ');
        }

    }

}
