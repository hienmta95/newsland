<?php

namespace Modules\Backend\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::user.index');
    }

    public function getThongtin(Request $request)
    {
        $info = User::where('id', '1')->first();
        return view('backend::thongtin.update', compact('info'));
    }

    public function postThongtin(Request $request)
    {
        $request->validate([
            'tencongty' => 'required',
            'emailcongty' => 'required',
            'diachicongty' => 'required',
            'sdtcongty' => 'required',
        ]);

        $user = User::where('id', '1')->first();

        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->updateImage($file, $user->image_id);
        } else {
            $image_id = $request->image_old;
        }

        $arr = array_merge($request->all(), ['banner_footer'=>$image_id]);
        $user->update($arr);

        $info = User::where('id', '1')->first();
        return view('backend::thongtin.update', compact('info'));
    }

    public function indexData()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.user.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.user.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.user.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button user="submit" class="submit-with-icon">
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
    public function create()
    {
        return view('backend::user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2|max:255|unique:users',
            'password' => 'required|min:6|max:255',
            'email' => 'required|email|unique:users',
        ]);

        $req = $request->all();
        $req['password'] = Hash::make($request->password);

        $user = User::create($req);

        return redirect()->route('backend.user.show', $user->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if($user)
            return view('backend::user.show', compact(['user']));
        return redirect()->route('backend.user.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $user = user::find($id);
        if($user)
            return view('backend::user.update', compact(['user']));
        return redirect()->route('backend.user.index');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required',
            'password_new' => 'max:255',
            'password_repeat' => 'same:password_new'
        ]);

        $user = User::find($request->id);

        if($user) {
            $password_new = $request->password_new;
            if(isset($password_new)) {
                $user->password = Hash::make($request->password_new);
            }

            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            return redirect()->route('backend.user.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.user.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        if($request->id != '1') {
            $user = User::find($request->id);
            $user->delete();
        }
        return redirect()->route('backend.user.index');
    }

}
