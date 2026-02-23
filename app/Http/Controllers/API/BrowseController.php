<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function browse(){
        $books = Book::all();
        $books = Book::paginate(2);
        return response()->json([ 
            "status" => 1,
            "message" => "Book Retrived",
            "data" => $books,
        ]);
    }
}
