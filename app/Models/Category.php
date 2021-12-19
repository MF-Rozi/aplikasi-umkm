<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasSlug, NodeTrait;

    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getParentNameAttribute()
    {
        if ($this->parent === null) {
            return 'null';
        } else {
            $parent = Category::find($this->parent);
            return $parent->name;
        }
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
