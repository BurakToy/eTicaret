<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class address extends Model
{
    use HasFactory,softDeletes;
    protected $table='addresses';
    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
