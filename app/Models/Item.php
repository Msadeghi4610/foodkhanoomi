<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable=[
        'order_id',
        'food_id',
        'count',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
