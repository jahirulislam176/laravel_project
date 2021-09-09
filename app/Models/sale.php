<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;
    public function relationtoshipping()
  {
    return $this->hasOne('App\Models\Shipping','id','shipping_id');
  }
}
