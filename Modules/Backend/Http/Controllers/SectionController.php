<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class sectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $position = $request->position;
        return view('backend::section.index', compact('position'));
    }

    public function indexData(Request $request)
    {
        $position = $request->position;
        $sections = Section::with(['image'])->where('position', $position)->get();
        return DataTables::of($sections)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->addColumn('action', function($row) use($position) {
                return
                    '<form method="POST" action="'. route("backend.section.destroy", ['position'=>$position, 'id'=>$row->id]) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.section.show", ['position'=>$position, 'id'=>$row->id]) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.section.edit", ['position'=>$position, 'id'=>$row->id]) .'"><span class="glyphicon glyphicon-pencil"></span></a>  
                <button sanpham="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button> 
            </form>';
            })
            ->rawColumns(['image'=>'image'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $position = $request->position;
        return view('backend::section.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $position = $request->position;
        $request->validate([
            'title' => 'required',
            'title_en' => 'required',
            'image' => 'required',
        ]);

        $req = $request->all();
        $req['position'] = $request->position;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }
        $req['image_id'] = $image_id;
        $section = section::create($req);

        return redirect()->route('backend.section.show', ['position'=>$position, 'id'=>$section->id]);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $position = $request->position;
        $section = Section::with(['image'])->find($id);
        if($section)
            return view('backend::section.show', ['position'=>$position], compact(['section']));
        return redirect()->route('backend.section.index', ['position'=>$position]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $position = $request->position;
        $id = $request->id;
        $section = section::with(['image'])->find($id);
        if($section)
            return view('backend::section.update', ['position'=>$position], compact(['section']));
        return redirect()->route('backend.section.index', ['position'=>$position]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $position = $request->position;
        $request->validate([

        ]);

        $section = Section::find($request->id);
        if($section) {
            $section->title = $request->title;
            $section->title_en = $request->title_en;
            $section->text2 = $request->text2;
            $section->video = $request->video;
            $section->link = $request->link;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $section->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $section->save();

            return redirect()->route('backend.section.show',  ['position'=>$position, 'id' =>$request->id]);
        }
        return redirect()->route('backend.section.index', ['position'=>$position]);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $section = section::find($request->id);
        $image_id = $section->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $section->delete();

        return redirect()->route('backend.section.index', ['position'=>$request->position]);
    }

}
