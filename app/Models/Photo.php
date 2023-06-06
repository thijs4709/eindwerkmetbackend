<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ["file"];
    protected $uploads='/assets/';
    //accessor

    //getFileAttribute: samenstelling
    public function getFileAttribute($photo){
        return $this->uploads .$photo;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->hasOne(Post::class);
    }
    public function box()
    {
        return $this->hasOne(Box::class);
    }
    public function card()
    {
        return $this->hasOne(Card::class);
    }

}
