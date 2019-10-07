<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $guarded = ['id'];

    public function messages()
    {

        return $this->hasMany('App\Message');
    }
}
