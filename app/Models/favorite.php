<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class favorite extends Model
{
    use HasFactory,softDeletes;
    protected $table = 'favorites';
    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
