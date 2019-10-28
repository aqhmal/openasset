<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get assets for the category.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function assets()
    {
        return $this->hasMany('App\Asset');
    }

    /**
     * Get assets count for the category
     *
     * @return int
     */
    public function assets_count()
    {
        return $this->assets()->count();
    }
}
