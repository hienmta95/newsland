<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Gioithieu;
use App\Tintuc;
use App\Noithat;

class PageController extends Controller
{

    // list

    public function getGioithieuList(Request $request){

        $trang = [
            'title' => 'Giới thiệu',
            'route1' => 'gioithieu.list',
            'route2' => 'gioithieu'
        ];

        $items = Gioithieu::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $this->returnPageList($trang, $items);
    }

    public function getNoithatList(Request $request){
        $trang = [
            'title' => 'Nội thất',
            'route1' => 'noithat.list',
            'route2' => 'noithat'
        ];

        $items = Noithat::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $this->returnPageList($trang, $items);
    }

    public function getTintucList(Request $request){
        $trang = [
            'title' => 'Tin tức',
            'route1' => 'tintuc.list',
            'route2' => 'tintuc'
        ];

        $items = Tintuc::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $this->returnPageList($trang, $items);
    }

    public function returnPageList($trang, $items)
    {
        return view('frontend::pages.tintuc', compact(['trang', 'items']));
    }

    // item

    public function getGioithieu(Request $request){
        $id = $request->id;
        $item = Gioithieu::findOrFail($id);

        $trang = [
            'title' => 'Giới thiệu',
            'route1' => 'gioithieu.list',
            'route2' => 'gioithieu'
        ];

        $same = Gioithieu::with(['image'])
            ->where('id', '!=', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();

        return $this->returnPageitem($trang, $item, $same);
    }

    public function getNoithat(Request $request){
        $id = $request->id;
        $item = Noithat::findOrFail($id);

        $trang = [
            'title' => 'Nội thất',
            'route1' => 'noithat.list',
            'route2' => 'noithat'
        ];

        $same = Noithat::with(['image'])
            ->where('id', '!=', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
        return $this->returnPageitem($trang, $item, $same);
    }

    public function getTintuc(Request $request){
        $id = $request->id;
        $item = Tintuc::findOrFail($id);

        $trang = [
            'title' => 'Tin tức',
            'route1' => 'tintuc.list',
            'route2' => 'tintuc'
        ];

        $same = Tintuc::with(['image'])
            ->where('id', '!=', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
        return $this->returnPageitem($trang, $item, $same);
    }

    public function returnPageitem($trang, $item, $same)
    {
        return view('frontend::pages.chitiettintuc', compact(['trang', 'item', 'same']));
    }

}
