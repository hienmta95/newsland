<?php

namespace Modules\Backend\Http\Controllers;

use App\Quan;
use App\Thanhpho;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class quanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::quan.index');
    }

    public function indexData()
    {
        $quans = Quan::select('quans.*');
        return DataTables::of($quans)
            ->editColumn('thanhpho',function ($row){
                return "<p>". $row->thanhpho->title ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.quan.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.quan.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.quan.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button type="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'thanhpho' => 'thanhpho'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $thanhpho = Thanhpho::all();
        return view('backend::quan.create', compact(['thanhpho']));
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
            'thanhpho_id' => 'required',
        ]);

        $req = $request->all();
        $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
        $quan = Quan::create($req);
        return redirect()->route('backend.quan.show', $quan->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $quan = Quan::findOrFail($id);
        if($quan)
            return view('backend::quan.show', compact(['quan']));
        return redirect()->route('backend.quan.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $quan = Quan::findOrFail($id);
        $thanhpho = Thanhpho::all();
        if($quan)
            return view('backend::quan.update', compact(['quan', 'thanhpho']));
        return redirect()->route('backend.quan.index');
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
            'thanhpho_id' => 'required',
        ]);

        $quan = Quan::findOrFail($id);

        if($quan) {
            $req = $request->all();
            $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
            $quan->update($req);

            return view('backend::quan.show', compact(['quan']));
        }
        return redirect()->route('backend.quan.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $quan = Quan::findOrFail($id);

        $imageFile = new ImageFile();
        $records = Bietthu::where('quan_id', $id)->get();
        foreach ($records as $record) {
            $image_delete = $imageFile->deleteImage($record->image_id);
            $record->delete();
        }
        $quan->delete();

        return redirect()->route('backend.quan.index');
    }

}
