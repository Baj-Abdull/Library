<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\BookAddRequest;
use App\Http\Requests\BookEditRequest;
use App\Http\Requests\BookDeleteRequest;
class LibrarianController extends Controller
{
    public function add(BookAddRequest $request){
        
        $book = Book::create($request->validated());
        // $data = new BookResource($book);
        return response()->json([ 
            "status" => 201,
            "message" => "Book Added",
            "data" => [
                'book' => new BookResource($book),
                'created_at' => $book->created_at,
            ],
        ], 201);

    

    }
    public function edit(BookEditRequest $request, $id){
        $book = Book::findOrFail($id); //whereId give (0,1) only
        $book->update($request->validated());
        
        
        return response()->json([ 
            "status" => 1,
            "message" => "Book Updated",
            "data" => [
                'book' => new BookResource($book),
                'updated_at' => $book->updated_at,
            ],
        ]);
        // return new BookResource($book);

    }
    public function delete($id){
        $book = Book::findOrFail($id);
        $book->delete();
        // $data = new BookResource($book);
        return response()->json([ 
            "status" => 1,
            "message" => "Book Deleted",
            "data" => [
                'book' => new BookResource($book),
            ],
        ]);
    
    
    }
}
