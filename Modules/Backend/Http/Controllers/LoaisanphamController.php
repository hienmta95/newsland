<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Loaisanpham;
use App\Bietthu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class LoaisanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::loaisanpham.index');
    }

    public function indexData()
    {
        $loaisanphams = Loaisanpham::with(['image'])->get();
        return DataTables::of($loaisanphams)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->editColumn('description',function ($row){
                return "<p>". substr($row->description, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.loaisanpham.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.loaisanpham.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.loaisanpham.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button loaisanpham="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'description' => 'description', 'image' => 'image'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::loaisanpham.create');
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
            'title_en' => 'required',
            'slug' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }

        $req = $request->all();
        $loaisanpham = Loaisanpham::create(array_merge($req, ['image_id' => $image_id]));

        return redirect()->route('backend.loaisanpham.show', $loaisanpham->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $loaisanpham = Loaisanpham::with(['image'])->find($id);
        if($loaisanpham)
            return view('backend::loaisanpham.show', compact(['loaisanpham']));
        return redirect()->route('backend.loaisanpham.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $loaisanpham = Loaisanpham::with(['image'])->find($id);
        if($loaisanpham)
            return view('backend::loaisanpham.update', compact(['loaisanpham']));
        return redirect()->route('backend.loaisanpham.index');
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
            'title_en' => 'required',
            'slug' => 'required',
        ]);
        $loaisanpham = Loaisanpham::find($id);

        if($loaisanpham) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $loaisanpham->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $loaisanpham->title = $request->title;
            $loaisanpham->title_en = $request->title_en;
            $loaisanpham->slug = $request->slug;
            $loaisanpham->image_id = $image_id;
            $loaisanpham->description = $request->description;
            $loaisanpham->description_en = $request->description_en;
            $loaisanpham->save();

            return redirect()->route('backend.loaisanpham.show', $loaisanpham->id);
        }
        return redirect()->route('backend.loaisanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $loaisanpham = Loaisanpham::find($id);
        $image_id = $loaisanpham->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $loaisanpham->delete();

        $abcs = Bietthu::where('loaisanpham_id', $id)->get();
        foreach($abcs as $abc) {
            $image_delete = $imageFile->deleteImage($abc->image_id);
            $abc->delete();
        }

        return redirect()->route('backend.loaisanpham.index');
    }

}
