<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order_item extends Model
{
    use HasFactory,softDeletes;
    protected $table='order_items';
    public function getOrder(){
        return $this->belongsTo(order::class,'order_id','id');
    }
}
