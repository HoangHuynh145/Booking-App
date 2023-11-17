<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        "userId",
        "hotel",
        "price",
        "tax",
        "totalPayment",
        "checkInTime",
        "checkOutTime"
    ];
}