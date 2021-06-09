<?php

namespace App\Model\front;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
     protected $table="order_items";

    public function orderMeta(){
        return $this->hasMany('\App\Model\front\Order_itemmeta','order_item_id','order_item_id');
    }

    public function postMeta(){
        return $this->hasMany('\App\Model\front\Postmeta','post_id','product_id');
    }

  



}
