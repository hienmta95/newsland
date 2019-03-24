<?php

namespace Modules\Backend\Http\Controllers;

use App\Gioithieu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class GioithieuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::gioithieu.index');
    }

    public function indexData()
    {
        $gioithieus = Gioithieu::with(['image'])->get();
        return DataTables::of($gioithieus)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->editColumn('tomtat',function ($row){
                return "<p>". mb_convert_encoding(substr($row->tomtat, 0, 100), 'UTF-8', 'UTF-8')."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.gioithieu.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.gioithieu.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.gioithieu.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button gioithieu="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'tomtat' => 'tomtat', 'image' => 'image'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::gioithieu.create');
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
            'image' => 'required',
        ]);

        $image_id = 0;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }

        $req = $request->all();
        $gioithieu = $image_id != 0 ? Gioithieu::create(array_merge($req, ['image_id' => $image_id])) : Gioithieu::create($req);

        return redirect()->route('backend.gioithieu.show', $gioithieu->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $gioithieu = Gioithieu::with(['image'])->findOrFail($id);

        if($gioithieu)
            return view('backend::gioithieu.show', compact(['gioithieu']));

        return redirect()->route('backend.gioithieu.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $gioithieu = Gioithieu::with(['image'])->find($id);
        if($gioithieu)
            return view('backend::gioithieu.update', compact(['gioithieu']));
        return redirect()->route('backend.gioithieu.index');
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
        ]);
        $gioithieu = Gioithieu::find($id);

        if($gioithieu) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $gioithieu->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $gioithieu->title = $request->title;
            $gioithieu->slug = $request->slug;
            $gioithieu->noidung = $request->noidung;
            $gioithieu->tomtat = $request->tomtat;
            $gioithieu->image_id = $image_id;
            $gioithieu->save();

            return redirect()->route('backend.gioithieu.show', $gioithieu->id);

        }
        return redirect()->route('backend.gioithieu.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $gioithieu = Gioithieu::find($id);
        $image_id = $gioithieu->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $gioithieu->delete();

        return redirect()->route('backend.gioithieu.index');
    }

}
