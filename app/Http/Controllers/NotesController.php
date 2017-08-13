<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Note;
use App\Delete;
use App\User;
use App\Book;
use Session;
use App\EnglishDeviceBag;


class NotesController extends Controller
{
    public function seeNote($id){
    	$found_note = Note::find($id);
    	return view('Notes.see-note',compact('found_note'));
    }
    public function makeNote(){
    	return view('Notes.make-note');
    }

    public function saveNote(Request $request,$userId){
    	$new_note = new Note();
    	$new_note->title = $request->title;
    	$new_note->note = Crypt::encryptString($request->note);
        $new_note->user_id =$userId;
        $new_note->skeleton_form = $request->piece_skeletal_form;
        $new_note->mother_values = $request->mother_values;
        $new_note->mother_names = $request->mother_names;
    	if ($new_note->save()){
            Session::forget('DeviceBag');
            Session::forget('temporaryPiece');
            Session::forget('devicesExist');
    		return redirect()->route('home',Session::get('username'))->with('success','Your note "'.$new_note->title.'" has been successfully saved!');
    	}
    }

    public function revampPiece(Request $request,$pieceRevampID){
        //save piece body and title and set revamp value
        //clear Device Bag before we start the revamp process
        $revampBag = new EnglishDeviceBag(null);
        if(Session::has('DeviceBag')){
            Session::forget('DeviceBag');
            Session::forget('devicesExist');
        }
        $found = Note::find($pieceRevampID);
        $motherNameList = explode('<--->',$found->mother_names);
        $motherValueList = explode('<--->',$found->mother_values);
        $count = 0;
        foreach ( $motherNameList as  $name) {
                $motherKey = $this->lookForMother($name);
                $revampBag->addDevice($motherKey,$name,$motherValueList[$count]);
                $count++;
        }
        Session::put('DeviceBag',$revampBag);
        Session::put('devicesExist','yes');
        Session::put('temporaryPiece',['title' => $request->piece_title, 'body' =>$request->piece_body , 'skeletal_form'=>'']);
        Session::put('revamp','yes');
        return view('Notes.make-note',compact('pieceRevampID'));
    }

    public function cancelRevamp(){
        Session::forget('DeviceBag');
        Session::forget('revamp');
        Session::forget('devicesExist');
        Session::forget('temporaryPiece');
        return redirect()->route('home',Session::get('username'));
    }
    public function doRevamp(Request $request){
        $found_piece = Note::find($request->pieceRevampID);
        if($found_piece->update([ 'title' => $request->title, 'body' =>$request->title, 'skeleton_form' =>$request->piece_skeletal_form,'mother_values'=>$request->mother_values,'mother_names'=>$request->mother_names])){
            Session::forget('DeviceBag');
            Session::forget('revamp');
            Session::forget('devicesExist');
            Session::forget('temporaryPiece');
            return redirect()->route('home',Session::get('username'))->with('success','"'.$request->title.'" has been successfully revamped!');
        }
    }
    public function editNote(Request $request,$id){
        $found_note = Note::find($id);
        if ($found_note->update(['title'=>$request->title,'note'=>Crypt::encryptString($request->note),'skeleton_form' =>$request->skeletal_form])){
            return back()->with('success','All changes to "'.$request->title.'" have been made successfully!');
        }
    }
    public function deleteNote($id){
        $del = new Delete();
        $found_note = Note::find($id);
        $del->title =  $found_note->title ;
        $del->note = $found_note->note;
        if ($del->save()){
            if($found_note->delete()){
                return redirect()->route('home',Session::get('username'))->with('success','"'.$found_note->title.'" has been successfully deleted!');
            }
        }
    }

    public function lookForMother($motherName){
        switch ($motherName) {
            case 'Metaphor':
                return 1;
                break;
            case 'Simile':
                return 2;
                break;
            case 'Pun':
                return 3;
                break;
            case 'Proverb':
                return 4;
                break;
            case 'Alliteration':
                return 5;
                break;
            case 'Allegory':
                return 6;
                break;
            case 'Euphemism':
                return 7;
                break;
            case 'Foreshadowing':
                return 8;
                break;
            case 'Imagery':
                return 9;
                break;
            case 'Personification':
                return 10;
                break;
            case 'Epigraph':
                return 11;
                break;
            case 'Hyperbole':
                return 12;
                break;
            case 'Idiom':
                return 13;
                break;
            case 'Anecdote':
                return 14;
                break;
            case 'Anthropomorphism':
                return 15;
                break;
            case 'Antithesis':
                return 16;
                break;
            case 'Assonance':
                return 17;
                break;
            case 'Characterisation':
                return 18;
                break;
            case 'Euphony':
                return 19;
                break;
            case 'Flashback':
                return 20;
                break;
            case 'Hyperbaton':
                return 21;
                break;

            default:
                break;
        }
    }




    public function encrypt($string){
        //get the raw string
        //change it to it's ascii value
        //encrypt
        //change it back to characters
        // and store that new string
        $splitted = str_split($string);
        $new_string = "";
        foreach ($splitted as $letter) {
            $let_numb = ord($letter);
            $let_numb = $let_numb + 20;
            $new_let = chr($let_numb);
            $new_string = $new_string.$new_let;
        }
        return $new_string;
    }


    public function decrypt($string){
        //get the string
        //change all letters to their ascii values
        //decrypt
        //change them back to their characters
        //and boom! zambezi
        $splitted= str_split($string);
        $old_string = "";
        foreach ($splitted as $letter) {
            $let_numb = ord($letter);
            $let_numb = $let_numb - 20;
            $new_let = chr($let_numb);
            $old_string = $old_string.$new_let;
        }

        return $old_string;

    }










}
