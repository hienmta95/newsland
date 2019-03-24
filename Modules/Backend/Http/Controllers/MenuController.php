<?php

namespace Modules\Backend\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::menu.index');
    }

    public function indexData()
    {
        $menus = menu::select('menus.*');
        return DataTables::of($menus)
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.menu.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.menu.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.menu.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button type="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('backend::menu.create');
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
        ]);

        $menu = Menu::create($request->all());
        return redirect()->route('backend.menu.show', $menu->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $menu = Menu::findOrFail($id);
        if($menu)
            return view('backend::menu.show', compact(['menu']));
        return redirect()->route('backend.menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $menu = Menu::findOrFail($id);
        if($menu)
            return view('backend::menu.update', compact(['menu']));
        return redirect()->route('backend.menu.index');
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
        ]);

        $menu = Menu::findOrFail($id);

        if($menu) {
            $menu->update($request->all());

            return view('backend::menu.show', compact(['menu']));
        }
        return redirect()->route('backend.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('backend.menu.index');
    }

}
