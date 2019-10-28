<?php

namespace App;

use App\Categories;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku', 'price', 'quantity', 'description', 'category_id', 'image'
    ];

    /**
     * Retrieve asset's category information.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
