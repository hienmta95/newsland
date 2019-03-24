<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gioithieu extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'image_id', 'slug', 'tomtat', 'noidung'
    ];


    protected $hidden = [
        //
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

}
