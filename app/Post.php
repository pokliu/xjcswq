<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'admin_id', 'type', 'title', 'content', 'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function admin(){
        return $this->belongsTo('App\Admin', 'admin_id');
    }
}
