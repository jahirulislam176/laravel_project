<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

   use SoftDeletes;
    use HasFactory;
    Protected $fillable=['product_name','product_Description','product_price','product_quantity','alert_quantity','product_image'];

function relationToCategory(){
  return $this->hasOne('App\Models\Category','id','category_id');
}

}
