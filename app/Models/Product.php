<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function pictures(){
        return $this->hasMany(ProductPicture::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
