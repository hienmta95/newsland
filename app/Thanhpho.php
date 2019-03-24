<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thanhpho extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'tenmien', 'slug'
    ];


    protected $hidden = [
        //
    ];

    public function quan()
    {
        return $this->hasMany(Quan::class, 'thanhpho_id', 'id');
    }

}
