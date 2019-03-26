<?php

namespace Modules\Backend\Components;
use App\Image;
use Illuminate\Support\Facades\DB;

class ImageFile {

    public function saveImage($file)
    {
        $nameonly = preg_replace('/\..+$/', '', $file->getClientOriginalName());
        $fullname = $nameonly.'-'.time().'.'.$file->getClientOriginalExtension();
        $location = public_path('backend/upload/images/'.$fullname);

//        $createFile = \Image::make($file);
//        $resize_save = $createFile->save($location);

        $file->move("backend/upload/images/", $location);

        $img = new Image();
        $img->url = 'backend/upload/images/'. $fullname;
        $img->name = $fullname;
        $img->save();

        return $img->id;
    }

    public function deleteImage($image_id)
    {
        $image_delete = Image::find($image_id);
        if($image_delete) {
            $file_path = public_path('backend/upload/images/'.$image_delete->name);
            unlink($file_path);
            return $image_delete->delete();
        }
        return 0;
    }

    public function updateImage($file, $image_id)
    {
        $image_delete = Image::find($image_id);
        if($image_delete) {
            $file_path = public_path('backend/upload/images/'.$image_delete->name);
            unlink($file_path);
        }

        $nameonly = preg_replace('/\..+$/', '', $file->getClientOriginalName());
        $fullname = $nameonly.'-'.time().'.'.$file->getClientOriginalExtension();
        $location = public_path('backend/upload/images/'.$fullname);

//        $createFile = \Image::make($file);
//        $resize_save = $createFile->save($location);

        $file->move("backend/upload/images/", $location);

        $img = Image::find($image_id);
        if($img) {
            $img->url = 'backend/upload/images/'. $fullname;
            $img->name = $fullname;
            $img->save();

            return $img->id;
        } else {
            $new = $this->saveImage($file);
            return $new;
        }
        return 0;
    }

}
