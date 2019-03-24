<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quan extends Model
{
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at', 'thanhpho_id', 'slug'
    ];


    protected $hidden = [
        //
    ];

    public function thanhpho()
    {
        return $this->belongsTo(Thanhpho::class, 'thanhpho_id', 'id');
    }

}
