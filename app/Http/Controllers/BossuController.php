<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\User;
use App\Book;
use Session;
use App\Publish;
use App\PieceAccount;
use Auth;
use App\Rank;
class BossuController extends Controller
{

    public function bossuDelUser($id){
        $found = User::find($id);
        if($found){
            $found->delete();
            return redirect()->route('bossu.login')->with('success',$found->name.' has been removed from merge write');
        }
    }
    public function changeRights($id){
        $siphiwe = Rank::find(1);
        $found_user = User::find($id);
        $found_user->rank->update(['rank'=>$siphiwe->rank,'rank_worth'=>$siphiwe->rank_worth,'rank_description'=>$siphiwe->rank_description,'rank_cost'=>$siphiwe->rank_cost,'number'=>$siphiwe->id]);
        $found_user->update(['is_mentor'=>1]);
    }
    public function searchForUser($userName){
        $same = User::where('name',$userName)->paginate(40);
            // $similar = User::where(substr('name',0,3),substr($userName,0,3))->paginate(40);
        return view('fragments.bossu-search',compact('same'));
    }
    public function refreshBossu(){
        return view('fragments.bossurefresh');
    }
    public function authenticateBossu(Request $request){
        if($request->bossuPassword =='Bossu-baakop3'){
            Session::put('bossu-authenticated',1);
        }else{
            Session::put('bossu-error','The token you entered is invalid!');
        }
    }
    public function showBossuLogin(){
        return view('foreign.bossu');
    }
}
