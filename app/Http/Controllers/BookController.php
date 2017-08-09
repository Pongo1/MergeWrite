<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Chapter;
use App\Page;
use Session;

class BookController extends Controller
{

    public function deleteBook($book_id){
        $book = Book::find($book_id);
        if ($book->delete()){
            return redirect()->route('home',Session::get('username'))->with('success',"Your book '".$book->Title."'"." has been successfully deleted!");
        }

    }
    public function showBookView(Request $request, $book_id){

        $foundBook = Book::find($book_id);
        Session::put('bookId',$book_id);
        Session::put('selectedBook',$foundBook);
        return view('Book.book-view',compact('foundBook'));

    }

    public function createBook(Request $request){

            $book = new Book();
            $book->user_id = $request->user_id;
            $book->Title = $request->book_name;
            if($book->save()){
                return redirect()->route('home',Session::get('username'))->with('success',"'".$request->book_name."' has been created, Start writing!");
            }
    }

    public function deleteChapter($chapter_id){

        $chapter = Chapter::find($chapter_id);
        if($chapter->delete()){
            Session::forget('chapter');
            return
             redirect()->route('book.view',$chapter->book_id)->with('success'," ' ".$chapter->chapter_title." ' ".' has been deleted from this book.');
        }

    }

    public function showChapter($book_id,$chapter_id){

        $userBook = Book::find($book_id);
        $chapter = $userBook->chapters->where('id',$chapter_id)->first();
        Session::forget('chapter');
        Session::put('chapter',$chapter);
        //return Session::get('chapter')->chapter_title;
        return redirect()->route('book.view',$book_id);
    }

    public function showPage($page_id){
        $page = Page::find($page_id);
        return view('Book.see-page',compact('page'));
    }

    public function createChapter(Request $request, $book_id){

        $chapter = new Chapter();
        $chapter->chapter_title = $request->chapter_name;
        $chapter->short_intro = $request->chapter_description;
        $chapter->book_id = $request->book_id;
        if($chapter->save()){
            return redirect()->route('book.view',$book_id)->with('success',"'".$request->chapter_name."'".' has been created! A new chapter has begun!');
        }

    }
    public function makePage(){

        return view('Book.add-page');
    }

    public function createPage(Request $request,$chapter_id){
        $page = new Page();
        $page->chapter_id = $chapter_id;
        $page->page_title = $request->page_title;
        $page->body = $request->page_body;
        if($page->save()){
            return redirect()->route('book.view',Session::get('bookId'))->with('success',"'".$request->page_title."'".' has been created! A page  has been added to '.Session::get('chapter')->chapter_title);
        }
    }

    public function deletePage($page_id){
        $foundPage= Page::find($page_id);
        if ($foundPage->delete()){
            return redirect()->route('book.view',Session::get('bookId'))->with('success',"'".$foundPage->page_title."'".' has successfully deleted from '.Session::get('selectedBook')->Title);
        }
    }

    public function editBookName(Request $request,$book_id){
        $foundBook = Book::find($book_id);
        $oldName = $foundBook->Title ;
        $foundBook->Title = $request->book_title;

        if($foundBook->update()){
            return redirect()->route('book.view',$book_id)->with('success',"'".$oldName."'".' has been changed to '.$foundBook->Title);
        }
    }

    public function editChapterName(Request $request,$book_id,$chapter_id){
        $foundChapter = Chapter::find($chapter_id);
        $oldName = $foundChapter->chapter_title;
        $foundChapter->chapter_title =$request->chapter_title;
        $foundChapter->short_intro = $request->chapter_short_intro;
        if($foundChapter->update()){
            return redirect()->route('book.view',$book_id)->with('success',"'".$oldName."'".' has been changed to '.$foundChapter->chapter_title);
        }
    }

    public function editPage(Request $request,$page_id){
        $foundPage = Page::find($page_id);
        $foundPage->page_title = $request->title;
        $foundPage->body =$request->page_body;
        if($foundPage->update()){
            return redirect()->route('page.show',$page_id)->with('success',"Changes have been made to '".$foundPage->page_title."'".' in '.Session::get('selectedBook')->Title);
        }
    }


    public function show(){
        return Session::get('chapter')->pages;
    }
































}
