<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Tintuc;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class tintucController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::tintuc.index');
    }

    public function indexData()
    {
        $tintucs = Tintuc::with(['image'])->get();
        return DataTables::of($tintucs)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->editColumn('tomtat',function ($row){
                return "<p>". mb_convert_encoding(substr($row->tomtat, 0, 100), 'UTF-8', 'UTF-8')."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.tintuc.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.tintuc.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.tintuc.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button tintuc="submit" class="submit-with-icon">
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
        return view('backend::tintuc.create');
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
        $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
        $tintuc = $image_id != 0 ? Tintuc::create(array_merge($req, ['image_id' => $image_id])) : Tintuc::create($req);

        return redirect()->route('backend.tintuc.show', $tintuc->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $tintuc = Tintuc::with(['image'])->findOrFail($id);

        if($tintuc)
            return view('backend::tintuc.show', compact(['tintuc']));

        return redirect()->route('backend.tintuc.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $tintuc = Tintuc::with(['image'])->find($id);
        if($tintuc)
            return view('backend::tintuc.update', compact(['tintuc']));
        return redirect()->route('backend.tintuc.index');
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
            'noidung' => 'required',
            'tomtat' => 'required',
        ]);
        $tintuc = Tintuc::find($id);

        if($tintuc) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $tintuc->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $tintuc->title = $request->title;
            $tintuc->slug = empty($request->slug) ? changeTitle($request->title) : $request->slug;
            $tintuc->noidung = $request->noidung;
            $tintuc->tomtat = $request->tomtat;
            $tintuc->image_id = $image_id;
            $tintuc->save();

            return redirect()->route('backend.tintuc.show', $tintuc->id);

        }
        return redirect()->route('backend.tintuc.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $tintuc = Tintuc::find($id);
        $image_id = $tintuc->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $tintuc->delete();

        return redirect()->route('backend.tintuc.index');
    }

}
