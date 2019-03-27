<?php

namespace Modules\Backend\Http\Controllers;

use App\Mucnoidung;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class MucnoidungController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::mucnoidung.index');
    }

    public function indexData()
    {
        $mucnoidungs = Mucnoidung::all();
        return DataTables::of($mucnoidungs)

            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.mucnoidung.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.mucnoidung.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.mucnoidung.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
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
        return view('backend::mucnoidung.create');
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
        ]);

        $req = $request->all();
        $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
        $mucnoidung = Mucnoidung::create($req);
        return redirect()->route('backend.mucnoidung.show', $mucnoidung->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $mucnoidung = Mucnoidung::findOrFail($id);
        if($mucnoidung)
            return view('backend::mucnoidung.show', compact(['mucnoidung']));
        return redirect()->route('backend.mucnoidung.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $mucnoidung = Mucnoidung::findOrFail($id);
        if($mucnoidung)
            return view('backend::mucnoidung.update', compact(['mucnoidung']));
        return redirect()->route('backend.mucnoidung.index');
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
        ]);

        $mucnoidung = Mucnoidung::findOrFail($id);

        if($mucnoidung) {
            $req = $request->all();
            $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
            $mucnoidung->update($req);

            return view('backend::mucnoidung.show', compact(['mucnoidung']));
        }
        return redirect()->route('backend.mucnoidung.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $mucnoidung = Mucnoidung::findOrFail($request->id);
        $mucnoidung->delete();

        return redirect()->route('backend.mucnoidung.index');
    }

}
