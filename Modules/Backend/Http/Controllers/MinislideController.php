<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Minislide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class MinislideController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::minislide.index');
    }

    public function indexData()
    {
        $minislides = Minislide::with(['image'])->get();
        return DataTables::of($minislides)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.minislide.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.minislide.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.minislide.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
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
        return view('backend::minislide.create');
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

        $minislide = new Minislide();
        $minislide->title = $request->title;
        $minislide->image_id = $image_id;
        $minislide->link = $request->link;
        $minislide->save();

        return redirect()->route('backend.minislide.show', $minislide->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $minislide = Minislide::with(['image'])->find($id);

        if($minislide)
            return view('backend::minislide.show', compact(['minislide']));
        return redirect()->route('backend.minislide.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $minislide = Minislide::with(['image'])->find($id);
        if($minislide)
            return view('backend::minislide.update', compact(['minislide']));
        return redirect()->route('backend.minislide.index');
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

        $minislide = Minislide::find($id);

        if($minislide) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $minislide->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $minislide->title = $request->title;
            $minislide->image_id = $image_id;
            $minislide->link = $request->link;
            $minislide->save();

            return view('backend::minislide.show', compact(['minislide']));
        }
        return redirect()->route('backend.minislide.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $minislide = Minislide::find($id);
        $image_id = $minislide->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $minislide->delete();

        return redirect()->route('backend.minislide.index');
    }

}
