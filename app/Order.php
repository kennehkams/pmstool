<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\orders_details;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number'
    ];

    public function order_details(){
        return $this->hasMany('App\order_details'); 
    }
}
