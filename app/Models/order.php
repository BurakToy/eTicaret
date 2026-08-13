<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'orders';
    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getOrder_item(){
        return $this->hasMany(order_item::class,'order_id','id');
    }
    public function getOrder_status_history(){
        return $this->hasMany(order_status_history::class,'order_id','id');
    }
}
