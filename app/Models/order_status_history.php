<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order_status_history extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='order_status_history';
    public function getOrder(){
        return $this->belongsTo(order::class,'order_id','id');
    }
}
