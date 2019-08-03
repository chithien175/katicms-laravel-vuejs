<?php

namespace Modules\Ecommerce\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ecommerce\Entities\Category;
use Modules\Ecommerce\Entities\Gallery;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'code' , 'photo', 'description', 'body', 'publish', 'price', 'counter', 'user_id'
    ];

    function categories() {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    function galleries() {
        return $this->hasMany(Gallery::class);
    }
}