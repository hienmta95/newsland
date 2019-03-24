<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id', 'url', 'name', 'updated_at', 'description', 'created_at'
    ];


    protected $hidden = [
        //
    ];
}
