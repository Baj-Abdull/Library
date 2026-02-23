<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Requests\ReviewAddRequest;
use App\Http\Requests\ReviewEditRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add(ReviewAddRequest $request){ // dont put id in for Book_id, only for reviews table
        $review = Review::create($request->validated());
            return response()->json([ 
            "status" => 1,
            "message" => "Review Added",
            "data" => [
                'book' => new ReviewResource($review),
                'created_at' => $review->created_at,
            ],
        ]);

    }
    public function edit(ReviewEditRequest $request, $id){
        $review = Review::findOrFail($id); //whereId give (0,1) only
        $data = [];
        // $data['before'] = $review;
        $review->update($request->validated());
        // $data['after'] = new ReviewResource($review);
        return response()->json([ 
            "status" => 1,
            "message" => "Review Updated",
            "data" => [
                'book' => new ReviewResource($review),
                'updated_at' => $review->updated_at,
            ],
        ]);

    }
    public function delete($id){
        $review = Review::findOrFail($id); //whereId give (0,1) only
        $review->delete();
        return response()->json([ 
            "status" => 1,
            "message" => "Review Deleted",
            "data" => [
                'book' => new ReviewResource($review),
            ],
        ]);

    }
}
