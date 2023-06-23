<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $table = 'orders';
    
    protected $casts = [
        'Order_Date' => 'datetime:d/m/Y', 
        'Order_EarliestArrivalDate' => 'datetime:d/m/Y', 
        'Order_LatestArrivalDate' => 'datetime:d/m/Y', 
    ];
}
