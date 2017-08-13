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
class PublishesController extends Controller
{

    public function refreshLikes($piece_id){
        //wont even be used.. lool
        $number =0;
        $published_piece = Publish::find($piece_id);
        return view('fragments.likebox',compact('published_piece','number'));
    }
    public function like($piece_id){
        //find the published piece that is being liked
        $foundPublishedPiece = Publish::find($piece_id);
        $gain = 1 + Auth::user()->rank_worth;
        //check if the piece already has an account
        $pieceAccount = PieceAccount::where('publish_id',$piece_id)->first();
        if($pieceAccount){
            $pieceAccount->update(['coins' =>$pieceAccount->coins + $gain]);
        }else{
            $newAccount= new PieceAccount();
            $newAccount->publish_id = $piece_id;
            $newAccount->coins = $gain;
            $newAccount->save();
        }
        //look for the owner of the piece
        $publisher= User::where('id',$foundPublishedPiece->user_id)->first();
        //check if the user has a bank account
        $userBankAccount = UserBank::where('user_id',$publisher->id)->first();
        if($userBankAccount){
            //if the user has an account just update their coins
            $userBankAccount->update(['coins'=>$userBankAccount->coins + $gain]);
        }else{
            $newUserBankAccount = new UserBank();
            $newUserBankAccount->user_id = $publisher->id;
            $newUserBankAccount->coins = $gain;
            $newUserBankAccount->save();
        }
        $like = new Like();
        $like->publish_id = $piece_id;
        $like->user_id = Auth::user()->id;//This user id is for the one who is liking this piece not the author of the piece
        $like->save();
    }

    public function commentOn(Request $request){
        $comment= new Comment();
        $comment->user_id = Auth::user()->id ;
        $comment->publish_id = $request->piece_id;
        $comment->comment = $request->comment;
        $comment->save();
    }

    public function refreshComments($piece_id){
        $found = Publish::find($piece_id);
        return view('fragments.commentbox',compact('found'));
    }
    public function showNew(){
        $number = 0;
        $allPublishes = Publish::where('unpublished',0)->orderBy('id','DESC')->paginate(10);
        return view('foreign.published',compact('allPublishes','number'));
    }

    public function publishPiece($pieceID){
        $found_piece = Note::find($pieceID);
        $new_publish = new Publish();
        $new_publish->publisher_name = Auth::user()->name;
        $new_publish->user_id = Auth::user()->id;
        $new_publish->profile_picture = Auth::user()->profile_picture;
        $new_publish->piece_title = $found_piece->title;
        $new_publish->piece_body = Crypt::decryptString($found_piece->note);
        $new_publish->skeleton_form = $found_piece->skeleton_form;
        $new_publish->parent_piece = $found_piece->id;
        $new_publish->publisher_rank = Auth::user()->rank;
        if($new_publish->save()){
            if($found_piece->update(['published'=>1])){
                return redirect()->route('home',Auth::user()->name)->with('sucess',$found_piece->title.' has been published!');
            }
        }
    }

    public function pieceFullShow(Request $request,$pieceName){

        $found = Publish::find($request->piece_id);
        return view('foreign.fullview',['found'=>$found]);


    }



}
