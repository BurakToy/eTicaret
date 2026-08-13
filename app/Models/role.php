<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class role extends Model
{
    use HasFactory , softDeletes;
    protected $table='roles';
   public function getUser(){
       return $this->hasMany(User::class,'user_id','id');
   }
}
