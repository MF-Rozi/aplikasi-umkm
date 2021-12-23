<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    protected $guarded = ['id'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom(['first_name', 'last_name'])
        ->saveSlugsTo('slug');
    }
    public function getFullAdressAttribute()
    {
        $address = [];
        return "{$this->address1}, {$this->address2}, {$this->district}, {$this->province}, {$this->post_code}";
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
