<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['photo_id','name','description','price','slug'];

    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
