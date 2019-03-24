<?php

namespace Modules\Frontend\Http\Controllers;

use App\Lienhe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Bietthu;
use App\Video;
use App\Notifications\ToAdmin;

class FrontendController extends Controller
{

    public function getLienhethanhcong(Request $request)
    {
        return view('frontend::pages.lienhethanhcong');
    }

    public function getLienhe(Request $request)
    {
        return view('frontend::pages.lienhe');
    }

    public function postLienhe(Request $request)
    {
        $req = $request->all();
        $create = Lienhe::create($req);
        if($create) {
            $this->sendMailAdmin($request->all());
            return redirect()->route('get.thanhcong');

        }
        return view('frontend::pages.lienhe');
    }

    public function sendMailAdmin($data)
    {
        $admin = User::findOrFail('1');
        $user = new User();
        $user->email = $admin->emailcongty;
        $user->notify(new ToAdmin($data));
    }

    public function getSearch(Request $request)
    {
        $keyword = $request->keyword;
        $request->flashOnly(['keyword']);
        $key = preg_replace("/[^a-zA-Z0-9]+/", "", $keyword);

        $items = Bietthu::with(['images'])
            ->where('title', 'like', '%'.$key.'%')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        $trang = [
            'title' => 'Tìm kiếm' . $keyword,
        ];

        return view('frontend::pages.listbietthu', compact('trang','items'));
    }

    public function getVideos(Request $request)
    {
        $id = $request->id;

        $items = Video::orderBy('updated_at', 'desc')
            ->paginate(12);

        $trang = [
            'id' => '1',
            'slug' => 'videos',
            'title' => 'videos',
            'route' => 'videos',
        ];

        return view('frontend::pages.listvideo', compact(['trang', 'items']));
    }

}
