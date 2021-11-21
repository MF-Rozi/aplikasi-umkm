<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
