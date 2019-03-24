<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'order', 'slug'
    ];


    protected $hidden = [
        //
    ];

    public function bietthu()
    {
        return $this->hasMany(Bietthu::class, 'theloai_id', 'id');
    }

}
