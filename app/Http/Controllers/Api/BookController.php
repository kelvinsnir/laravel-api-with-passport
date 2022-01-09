<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
   public function createBook(Request $request)
   {
      //validate
      $request->validate([
         'title' => 'required',
         'book_code' => 'required|numeric'
      ]);
     //create book data
     $book = new Book();

     $book->author_id = auth()->user()->id;
     $book->title = $request->title;
     $book->description = $request->description;
     $book->book_code = $request->book_code;
     //save
     $book->save();
     //send response
     return response()->json([
        'status'=>1,
        'message'=>'successfully created'
     ]);
   }
   public function listBook()
   {
     $author_id = auth()->user()->id;

     $books_data = Author::find($author_id)->books;

     return response()->json([
        'status' => 1,
        'message'=>'authors book',
        'books' => $books_data
     ]);

   }
   public function singleBook($bookid)
   {
      $author_id = auth()->user()->id;
      if(Book::where(["author_id"=>$author_id, "id"=>$bookid])->exists())
      {
        $book = Book::find($bookid);

        return response()->json([
           'status'=>1,
           'message' => 'book',
           'data' => $book
        ]);
      }
      else{

         return response()->json([
            'status'=> 0,
            'message' => 'no data'
         ]);
      }

   }
   public function updateBook(Request $request , $bookid)
   {

   }
   public function deleteBook($bookid)
   {

   }
}
