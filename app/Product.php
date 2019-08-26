<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\order_details;
use App\supplier_products;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'quantity'
    ];
    
    //relationships
    public function order_details(){
        return $this->hasmany('App\order_details'); 
    }

    public function supplier_products(){
        return $this->hasmany('App\order_details'); 
    }
}
