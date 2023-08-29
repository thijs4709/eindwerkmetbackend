<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function box():BelongsTo
    {
        return $this->BelongsTo(Box::class);
    }
    public function card():BelongsTo
    {
        return $this->BelongsTo(Card::class);
    }

}
