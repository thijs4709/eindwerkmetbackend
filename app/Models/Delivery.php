<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable =[
        "street",
        "street_number",
        "city",
        "city_number",
        "delivery_time",
        "instructions",
    ];
    public function user()
    {
        $this->hasOne(User::class);
    }
}
