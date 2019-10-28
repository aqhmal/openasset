<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'asset_id', 'quantity', 'status'
    ];

    public function assets()
    {
        return $this->hasOne('\App\Asset', 'id', 'asset_id');
    }

    public function users()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
}
