<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory,softDeletes;
    protected $table='categories';

    public function getProduct(){
        return $this->hasMany(product::class,'category_id','id');
    }
}
