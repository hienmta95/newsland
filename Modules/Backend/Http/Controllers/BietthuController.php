<?php

namespace Modules\Backend\Http\Controllers;

use App\Bietthu;
use App\Quan;
use App\Theloai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;
use DB;

class bietthuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::bietthu.index');
    }

    public function indexData()
    {
        $bietthus = Bietthu::with(['image', 'quan', 'theloai'])->get();
        return DataTables::of($bietthus)
            ->addColumn('quan',function ($row){
                return $row->quan->title;
            })
            ->addColumn('theloai',function ($row){
                return $row->theloai->title;
            })
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->editColumn('tomtat',function ($row){
                return "<p>". mb_convert_encoding(substr($row->mota, 0, 100), 'UTF-8', 'UTF-8') ."</p>";
            })
            ->addColumn('hanhdong', function($row) {
                return
                    '<form method="POST" action="'. route("backend.bietthu.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.bietthu.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.bietthu.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button bietthu="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['hanhdong' => 'hanhdong', 'tomtat' => 'tomtat', 'image' => 'image', 'quan' => 'quan', 'theloai' => 'theloai'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $quan = Quan::all();
        $theloai = Theloai::where('id', '!=','4')->get();
        return view('backend::bietthu.create', compact(['quan', 'theloai']));
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
//            'image' => 'required',
            'trangthai' => 'required',
            'mota' => 'required',
            'quan_id' => 'required',
            'theloai_id' => 'required',
//            'images' => 'required'
        ]);

        $image_id = 0;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }

        $req = $request->all();
        $req['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;
        $bietthu = $image_id != 0 ? Bietthu::create(array_merge($req, ['image_id' => $image_id])) : Bietthu::create($req);

        if($request->images) {
            $arrImage = [];
            foreach ($request->images as $key=>$file) {
                $imageFile = new ImageFile();
                $image_id = $imageFile->saveImage($file);
                $arrImage[$key] = $image_id;
            }

            foreach ($arrImage as $image) {
                $bietthu->images()->attach($image);
            }
        }

        return redirect()->route('backend.bietthu.show', $bietthu->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $bietthu = Bietthu::with(['image', 'quan', 'theloai', 'images'])->findOrFail($id);

        if($bietthu)
            return view('backend::bietthu.show', compact(['bietthu']));

        return redirect()->route('backend.bietthu.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $quan = Quan::all();
        $theloai = Theloai::where('id', '!=','4')->get();
        $bietthu = Bietthu::with(['image', 'quan', 'theloai', 'images'])->find($id);
        if($bietthu)
            return view('backend::bietthu.update', compact(['bietthu', 'quan', 'theloai']));
        return redirect()->route('backend.bietthu.index');
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
            'trangthai' => 'required',
            'theloai_id' => 'required',
            'mota' => 'required',
            'quan_id' => 'required',
        ]);
        $bietthu = Bietthu::find($id);

        if($bietthu) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $bietthu->image_id);
            } else {
                $image_id = $request->image_old;
            }

            $filter = array_merge($request->all(), ['image_id' => $image_id]);
            $filter['slug'] = empty($request->slug) ? changeTitle($request->title) : $request->slug;

            $bietthu->update($filter);

            if($request->images) {
                $arrImage = [];
                foreach ($request->images as $key=>$file) {
                    $imageFile = new ImageFile();
                    $image_id = $imageFile->saveImage($file);
                    $arrImage[$key] = $image_id;
                }
                foreach ($arrImage as $image) {
                    $bietthu->images()->attach($image);
                }
            }

            return redirect()->route('backend.bietthu.show', $bietthu->id);

        }
        return redirect()->route('backend.bietthu.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $bietthu = Bietthu::find($id);
        $image_id = $bietthu->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);

        $bietthu->images()->detach();
        $bietthu->delete();

        return redirect()->route('backend.bietthu.index');
    }

    public function deleteImage(Request $request)
    {
        $image_id = $request->key;
        $bietthu_id = $request->bietthu_id;

        $delete = DB::table('bietthu_image')
            ->where('image_id', $image_id)
            ->where('bietthu_id', $bietthu_id)
            ->delete();

        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        return $delete;
    }

    public function uploadImage(Request $request)
    {
        return 1;
    }

}
