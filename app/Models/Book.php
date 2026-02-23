<?php

namespace App\Models;

use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

// #[UseResource(BookResource::class)]
class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'librarian_id',
    ];

    public function reviews(){
        $this->hasMany(Review::class);
    }

    public function librarian(){
        $this->belongsTo(Librarian::class);
    }
    // use SoftDeletes; //this give me error
}
