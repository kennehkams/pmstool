<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Order;
use App\Product;

class orderdetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id'
    ];


}
