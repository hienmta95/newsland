<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lienhe extends Model
{

    protected $fillable = [
        'id', 'hoten', 'created_at', 'updated_at', 'dienthoai', 'sdt', 'congty', 'diachi', 'email', 'chude', 'noidong', 'trangthai'
    ];

    protected $hidden = [
        //
    ];

}
