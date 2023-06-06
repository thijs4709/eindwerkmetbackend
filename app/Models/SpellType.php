<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpellType extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug'];

    public function card()
    {
        return $this->hasOne(Card::class);
    }
}
