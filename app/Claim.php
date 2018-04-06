<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'post_id', 'name', 'phone', 'email', 'location', 'bought_time', 'sold_time', 'description'
    ];

    public function post(){
        return $this->belongsTo('App\Post', 'post_id');
    }
}
