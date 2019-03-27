<?php

namespace Modules\Backend\Http\Controllers;

use App\Noithat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class NoithatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::noithat.index');
    }

    public function indexData()
    {
        $noithats = Noithat::with(['image'])->get();
        return DataTables::of($noithats)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->editColumn('tomtat',function ($row){
                return "<p>". mb_convert_encoding(substr($row->tomtat, 0, 100), 'UTF-8', 'UTF-8')."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.noithat.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.noithat.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.noithat.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button noithat="submit" class="submit-with-icon">
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
        return view('backend::noithat.create');
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
        $noithat = $image_id != 0 ? Noithat::create(array_merge($req, ['image_id' => $image_id])) : Noithat::create($req);

        return redirect()->route('backend.noithat.show', $noithat->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $noithat = Noithat::with(['image'])->findOrFail($id);

        if($noithat)
            return view('backend::noithat.show', compact(['noithat']));

        return redirect()->route('backend.noithat.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $noithat = Noithat::with(['image'])->findOrFail($id);
        if($noithat)
            return view('backend::noithat.update', compact(['noithat']));
        return redirect()->route('backend.noithat.index');
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
        $noithat = Noithat::findOrFail($id);

        if($noithat) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $noithat->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $noithat->title = $request->title;
            $noithat->slug = empty($request->slug) ? changeTitle($request->title) : $request->slug;
            $noithat->noidung = $request->noidung;
            $noithat->tomtat = $request->tomtat;
            $noithat->image_id = $image_id;
            $noithat->save();

            return redirect()->route('backend.noithat.show', $noithat->id);

        }
        return redirect()->route('backend.noithat.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $noithat = Noithat::findOrFail($id);
        $image_id = $noithat->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $noithat->delete();

        return redirect()->route('backend.noithat.index');
    }

}
