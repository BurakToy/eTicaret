<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stock_movement extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='stock_movements';
    public function getProduct(){
        return $this->belongsTo(product::class,'product_id','id');
    }
}
