<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    function relationToproduct(){
      return $this->hasOne('App\Models\Product','id','product_id');
    }

}
