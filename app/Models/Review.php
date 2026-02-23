<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'rate',
        'description',
        'book_id',
        'user_id',
    ];

    public function librarian(){
        $this->belongsTo(Librarian::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
