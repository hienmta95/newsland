<?php

namespace Modules\Backend\Http\Controllers;

use App\Thanhpho;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class thanhphoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::thanhpho.index');
    }

    public function indexData()
    {
        $thanhphos = Thanhpho::select('thanhphos.*');
        return DataTables::of($thanhphos)
            ->editColumn('tenmien',function ($row){
                $tenmien = $row->tenmien == "mienbac" ? "Miền Bắc" : ($row->tenmien == "mientrung" ? "Miền Trung" : "Miền Nam");
                return "<p>". $tenmien ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.thanhpho.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.thanhpho.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.thanhpho.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button type="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'tenmien' => 'tenmien'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('backend::thanhpho.create');
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
            'tenmien' => 'required',
        ]);

        $thanhpho = Thanhpho::create($request->all());
        return redirect()->route('backend.thanhpho.show', $thanhpho->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $thanhpho = Thanhpho::findOrFail($id);
        if($thanhpho)
            return view('backend::thanhpho.show', compact(['thanhpho']));
        return redirect()->route('backend.thanhpho.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $thanhpho = Thanhpho::findOrFail($id);
        if($thanhpho)
            return view('backend::thanhpho.update', compact(['thanhpho']));
        return redirect()->route('backend.thanhpho.index');
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
            'tenmien' => 'required',
        ]);

        $thanhpho = Thanhpho::findOrFail($id);

        if($thanhpho) {
            $thanhpho->update($request->all());

            return view('backend::thanhpho.show', compact(['thanhpho']));
        }
        return redirect()->route('backend.thanhpho.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $thanhpho = Thanhpho::findOrFail($id);
        $thanhpho->delete();

        $quans = Quan::where('thanhpho_id', $id)->get();
        foreach($quans as $item) {
            $item->delete();
        }

        return redirect()->route('backend.thanhpho.index');
    }

}