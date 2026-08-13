<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory,softDeletes;
    protected $table='products';
    public function getCategory(){
        return $this->belongsTo(category::class,'category_id','id');
    }
    public function getBrand(){
        return $this->belongsTo(brand::class,'brand_id','id');
    }
    public function getImage(){
        return $this->hasMany(product_image::class,'product_id','id');
    }
    public function getProductVariation(){
        return $this->hasMany(product_variant::class,'product_id','id');
    }
    public function getStock_movement(){
        return $this->hasMany(stock_movement::class,'product_id','id');
    }
}
