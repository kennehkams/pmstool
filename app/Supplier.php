<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\supplierProducts;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function supplier_products(){
        return $this->hasmany('App\supplier_products'); 
    }
}
