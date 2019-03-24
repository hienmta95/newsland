<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bietthu extends Model
{
    protected $fillable = [
        'id', 'title', 'slug', 'quan_id', 'theloai_id', 'gia', 'mota', 'chinhsach', 'tongquan', 'vitri', 'tienich', 'matbang', 'noithat', 'tiendo', 'hinhanh', 'image_id', 'trangthai', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        //
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

    public function theloai()
    {
        return $this->belongsTo(Theloai::class, 'theloai_id', 'id');
    }

    public function quan()
    {
        return $this->belongsTo(Quan::class, 'quan_id', 'id');
    }
}
