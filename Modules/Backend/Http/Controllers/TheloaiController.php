<?php

namespace Modules\Backend\Http\Controllers;

use App\Bietthu;
use App\Theloai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class theloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::theloai.index');
    }

    public function indexData()
    {
        $theloais = Theloai::select('theloais.*');
        return DataTables::of($theloais)
            ->editColumn('active',function ($row){
                if($row->active == 1)
                    return "<p>Có hiển thị</p>";
                return "<p>Không</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.theloai.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.theloai.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.theloai.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button type="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'active' => 'active'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('backend::theloai.create');
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
            'order' => 'required',
            'active' => 'required',
        ]);

        $req = $request->all();
        $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
        $theloai = Theloai::create($req);
        return redirect()->route('backend.theloai.show', $theloai->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $theloai = Theloai::findOrFail($id);
        if($theloai)
            return view('backend::theloai.show', compact(['theloai']));
        return redirect()->route('backend.theloai.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $theloai = Theloai::findOrFail($id);
        if($theloai)
            return view('backend::theloai.update', compact(['theloai']));
        return redirect()->route('backend.theloai.index');
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
            'order' => 'required',
            'active' => 'required',
        ]);

        $theloai = Theloai::findOrFail($id);

        if($theloai) {
            $req = $request->all();
            $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
            $theloai->update($req);

            return view('backend::theloai.show', compact(['theloai']));
        }
        return redirect()->route('backend.theloai.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        if($request->id != '4') {
            $id = $request->id;
            $theloai = Theloai::findOrFail($id);
            $imageFile = new ImageFile();

            $records = Bietthu::where('theloai_id', $id)->get();
            foreach ($records as $record) {
                $image_delete = $imageFile->deleteImage($record->image_id);
                $record->delete();
            }
            $theloai->delete();
        }
        return redirect()->route('backend.theloai.index');
    }

}
