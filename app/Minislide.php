<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minislide extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'link', 'image_id'
    ];


    protected $hidden = [
        //
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

}
