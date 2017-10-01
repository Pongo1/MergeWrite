<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Note;
use App\Publish;
use Auth;
use Crypt;
use App\Comment;
use App\Like;
use App\PieceAccount;
use App\UserBank;
use App\User;
use App\Grab;
use App\Invite;
use App\Notifications\AdminRemarkNotification;

class MentorController extends Controller
{



    public function mentorDelete($inviteID){
        $inv = Invite::find($inviteID);
        $inv->note->update(['marked'=>0]);
        $inv->delete();
    }
    public function mentorDone($inviteID){
        $inv = Invite::find($inviteID);
        $inv->delete();
    }
    public function refreshAwaiting($id){
        $found_note = Note::find($id);
        return view('fragments.waiting',compact('found_note'));
    }
    public function inviteMentor(Request $request){
        $inv = new Invite();
        $inv->inviter_name = Auth::user()->name;
        //mentor id
        $inv->user_id = $request->mentor_id;
        $inv->piece_title =$request->piece_title;
        $inv->link = '/see-note/'.$request->piece_id;
        $inv->note_id = $request->piece_id;
        $inv->save();
        Note::find($request->piece_id)->update(['marked'=>2]);
    }
    public function menteeMark($piece_id){
        $found = Note::find($piece_id);
        $found->update(['marked'=>0]);

    }

    public function mentorMark(Request $request){
        $found = Note::find($request->piece_id);
        //coins will be used later
        $found->update(['mentor_remark'=>$request->remarks,'marked'=>1,'mark_coins'=>$request->mark_coins]);
        $found->publish->bank->update(['coins'=>$found->publish->bank->coins + $request->mark_coins]);
        User::find($found->user_id)->notify(new AdminRemarkNotification(Auth::user(),$found,$request->mark_coins));
        return redirect()->route("home",Auth::user()->name);//and then clear that invite...
    }
}
