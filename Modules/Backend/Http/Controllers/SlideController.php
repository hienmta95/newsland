<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::slide.index');
    }

    public function indexData()
    {
        $slides = Slide::with(['image'])->select('slides.*');
        return DataTables::of($slides)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.slide.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.slide.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.slide.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button type="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'image'=>'image'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('backend::slide.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }

        $slide = new Slide();
        $slide->title = $request->title;
        $slide->image_id = $image_id;
        $slide->link = $request->link;
        $slide->save();

        return redirect()->route('backend.slide.show', $slide->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $slide = Slide::with(['image'])->find($id);
        if($slide)
            return view('backend::slide.show', compact(['slide']));
        return redirect()->route('backend.slide.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $slide = Slide::with(['image'])->find($id);
        if($slide)
            return view('backend::slide.update', compact(['slide']));
        return redirect()->route('backend.slide.index');
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

        ]);

        $slide = Slide::find($id);

        if($slide) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $slide->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $slide->title = $request->title;
            $slide->image_id = $image_id;
            $slide->link = $request->link;
            $slide->save();

            return view('backend::slide.show', compact(['slide']));
        }
        return redirect()->route('backend.slide.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $slide = Slide::find($id);
        $image_id = $slide->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $slide->delete();

        return redirect()->route('backend.slide.index');
    }

}
