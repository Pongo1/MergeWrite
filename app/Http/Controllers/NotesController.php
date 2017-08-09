<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Note;
use App\Delete;
use App\User;
use App\Book;
use Session;


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
    	if ($new_note->save()){
    		return redirect()->route('home',Session::get('username'))->with('success','Your note "'.$new_note->title.'" has been successfully saved!');
    	}

    }

    public function editNote(Request $request,$id){
        $found_note = Note::find($id);
        if ($found_note->update(['title'=>$request->title,'note'=>Crypt::encryptString($request->note)])){
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



    public function show(){
        $s ="ASCII stands for American Standard Code for Information Interchange. Computers can only understand numbers, so an ASCII code is the numerical representation of a character such as 'a' or '@' or an action of some sort. ASCII was developed a long time ago and now the non-printing characters are rarely used for their original purpose. Below is the ASCII character table and this includes descriptions of the first 32 non-printing characters. ASCII was actually designed for use with teletypes and so the descriptions are somewhat obscure. If someone says they want your CV however in ASCII format, all this means is they want 'plain' text with no formatting such as tabs, bold or underscoring - the raw format that any computer can understand. This is usually so they can easily import the file into their own applications without issues. Notepad.exe creates ASCII text, or in MS Word you can save a file as 'text only'";
        $enc =  $this->encrypt($s);

        echo $enc;

        echo '<br>';

        echo $this->decrypt($enc);
            // $string = str_split("string and shit");
            // $ar = [];
            // foreach ($string as  $letter) {
            //     echo ord($letter);
            //     echo "<br>";
            //     echo ord($letter)+20 < 256 ? ord($letter)+20 : ord($letter).(256 -ord($letter));
            //     array_push($ar,ord($letter)+20 < 256 ? ord($letter)+20 : ord($letter).(256 -ord($letter)));
            //     echo "<br>";
            //     # code...
            // }

            // foreach ($ar as $value) {
            //     echo chr($value-20);
            //     # code...
            // }

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
