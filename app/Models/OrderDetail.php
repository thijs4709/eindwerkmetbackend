<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "product_name",
        "product_original_price",
        "product_description",
        "card_id",
        "box_id",
    ];
}
