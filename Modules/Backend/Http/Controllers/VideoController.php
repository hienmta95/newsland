<?php

namespace Modules\Backend\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::video.index');
    }

    public function indexData()
    {
        $videos = Video::all();
        return DataTables::of($videos)
            ->editColumn('tomtat',function ($row){
                return "<p>". mb_convert_encoding(substr($row->tomtat, 0, 100), 'UTF-8', 'UTF-8')."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.video.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.video.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.video.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button video="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'tomtat' => 'tomtat'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::video.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'noidung' => 'required',
            'tomtat' => 'required',
            'video' => 'required',
        ]);

        $image_id = 0;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }

        $req = $request->all();
        $video = $image_id != 0 ? Video::create(array_merge($req, ['image_id' => $image_id])) : Video::create($req);

        return redirect()->route('backend.video.show', $video->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $video = Video::with(['image'])->findOrFail($id);

        if($video)
            return view('backend::video.show', compact(['video']));

        return redirect()->route('backend.video.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $video = Video::with(['image'])->find($id);
        if($video)
            return view('backend::video.update', compact(['video']));
        return redirect()->route('backend.video.index');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'noidung' => 'required',
            'tomtat' => 'required',
            'video' => 'required',
        ]);
        $video = Video::find($id);

        if($video) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $video->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $video->title = $request->title;
            $video->slug = $request->slug;
            $video->noidung = $request->noidung;
            $video->tomtat = $request->tomtat;
            $video->image_id = $image_id;
            $video->video = $request->video;
            $video->save();

            return redirect()->route('backend.video.show', $video->id);

        }
        return redirect()->route('backend.video.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $video = Video::find($id);
        $image_id = $video->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $video->delete();

        return redirect()->route('backend.video.index');
    }

}
