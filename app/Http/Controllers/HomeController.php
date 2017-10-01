<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\User;
use App\Book;
use Session;
use Auth;
use App\Publish;
use App\Rank;
use App\UserRank;
use App\UserBank;
use App\Invite;
use App\Notifications\ChangeRankNotification ;

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



     public function removeInst(){
         Auth::user()->update(['new'=>1]);
     }
    public function refreshShop(){
        $shopItems = Rank::all();
        return view('fragments.shop',compact('shopItems'));
    }
    public function buyRank($rankName){
        $oldRank = UserRank::where('user_id',Auth::user()->id)->first();
        $oldRankName = $oldRank->rank;
        //transaction
        $newRank = $this->getRank($rankName);
        $userAccount = UserBank::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->bank->coins > $newRank['COST']){
            $userNewCoins = Auth::user()->bank->coins - $newRank['COST'];
            if($userAccount->update(['coins'=>$userNewCoins])){
                $oldRank->update(['rank'=>$newRank['RANK'],'rank_worth'=>$newRank['WORTH'],'rank_description'=>'','number'=>$newRank['NUMBER'],'rank_cost'=>$newRank['COST']]);
                //and then show some notification
                Auth::user()->notify(new ChangeRankNotification($oldRankName,$newRank['RANK']));
            }
        }
    }
    public function getRank($rankName){
         switch ($rankName) {
             case 'Looker':
                return ['COST'=>500,'WORTH'=>50,'RANK'=>'Looker','NUMBER'=>10];
                 break;
             case 'Okri':
                return ['COST'=>5000,'WORTH'=>100,'RANK'=>'Okri','NUMBER'=>9];
                 break;
             case 'Aryi':
                return ['COST'=>5500,'WORTH'=>170,'RANK'=>'Aryi','NUMBER'=>8];
                 break;
             case 'Nurridin':
                return ['COST'=>6000,'WORTH'=>200,'RANK'=>'Nurridin','NUMBER'=>7];
                 break;
             case 'Shakespeare':
                return ['COST'=>7000,'WORTH'=>250,'RANK'=>'Shakespeare','NUMBER'=>6];
                 break;
             case 'Thiongo':
                return ['COST'=>8000,'WORTH'=>270,'RANK'=>'Thiongo','NUMBER'=>5];
                 break;
             case 'Ba':
                return ['COST'=>10000,'WORTH'=>300,'RANK'=>'Ba','NUMBER'=>4];
                 break;
             case 'Chimamanda':
                return ['COST'=>12500,'WORTH'=>400,'RANK'=>'Chimamanda','NUMBER'=>3];
                 break;
             case 'Chinua':
                return ['COST'=>250000,'WORTH'=>500,'RANK'=>'Chinua','NUMBER'=>2];
                 break;
             case 'Siphiwe':
                return ['COST'=>500000,'WORTH'=>1000,'RANK'=>'Siphiwe','NUMBER'=>1];
                 break;
             default:
                 # code...
                 break;
         }
     }
    public function index($username)
    {

        $user = User::where('name',$username)->first();

        if($user->is_mentor)
        {
            $invites = Invite::where('done',0)->orderBy('id','DESC')->paginate(10);
            return view('foreign.mentor',compact('invites'));
        }
        else
        {

            $shopItems = Rank::all();
            $user_Books = Book::orderBy('id','DESC')->where('user_id',$user->id)->paginate(15);
            $notes = Note::orderBy('id','DESC')->where('user_id',$user->id)->paginate(6);
            return view('home',compact('notes','user_Books','shopItems'));
        }

    }

    public function showProfile($username){
        $user = User::where('name',$username)->first();
        return view('profile.profile',compact('user'));

    }

    public function changeProfilePicture(Request $request){
        $user = User::find(Auth::user()->id);
        $allPublished = Auth::user()->publishes;

        if($request->hasFile('user_pic')){
            $ext = $request->user_pic->getClientOriginalExtension();
            if( $ext =='jpg' || $ext = 'JPG' || $ext =='jpeg' || $ext =='JPEG' || $ext =='png' || $ext =='PNG' || $ext =='gif' || $ext =='GIF' || $ext =='bmp' || $ext =='BMP'){
                $fileName = uniqid().'.'.$ext;
                if($request->user_pic->move('userimages',$fileName)){
                    if($user->update(['profile_picture'=>'userimages/'.$fileName])){
                        if(count($allPublished)>0){
                            foreach ($allPublished as $piece) {
                                $piece->update(['profile_picture'=>'userimages/'.$fileName]);
                            }
                        }
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
