<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //By default laravel bind the route with id
    //So for channel model i am changing the route to slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads(){
        return $this->hasMany('App\Thread');
    }
}
