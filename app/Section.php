<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'text2', 'link', 'position', 'image_id', 'video', 'title_en', 'description_en'
    ];


    protected $hidden = [
        //
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

}
