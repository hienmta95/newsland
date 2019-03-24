<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Lienhe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class LienheController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::lienhe.index');
    }

    public function indexData()
    {
        $lienhes = Lienhe::all();
        return DataTables::of($lienhes)
            ->editColumn('trangthai',function ($row){
                $abc = $row->trangthai == 1 ? 'Đã xử lý' : 'Chưa xử lý' ;
                return "<p>". $abc ."</p>";
            })
            ->editColumn('noidung',function ($row){
                return "<p>". substr($row->noidung, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.lienhe.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.lienhe.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.lienhe.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button lienhe="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'noidung' => 'noidung', 'trangthai'=>'trangthai'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::lienhe.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hoten' => 'required',
            'didong' => 'required',
            'email' => 'required',
            'noidung' => 'required',
        ]);

        $req = $request->all();
        $lienhe = Lienhe::create($req);

        return redirect()->route('backend.lienhe.show', $lienhe->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $lienhe = Lienhe::find($id);
        if($lienhe)
            return view('backend::lienhe.show', compact(['lienhe']));
        return redirect()->route('backend.lienhe.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $lienhe = Lienhe::find($id);
        if($lienhe)
            return view('backend::lienhe.update', compact(['lienhe']));
        return redirect()->route('backend.lienhe.index');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
        ]);

        $lienhe = Lienhe::find($request->id);
        if($lienhe) {
            $lienhe->trangthai = $request->trangthai;
            $lienhe->save();

            return redirect()->route('backend.lienhe.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.lienhe.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $lienhe = Lienhe::find($request->id);
        $lienhe->delete();

        return redirect()->route('backend.lienhe.index');
    }

}
