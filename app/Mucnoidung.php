<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mucnoidung extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'slug'
    ];


    protected $hidden = [
        //
    ];

}
