<?php

namespace Modules\Frontend\Http\Controllers;

use App\Quan;
use App\Thanhpho;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Bietthu;
use App\Theloai;

class BietthuController extends Controller
{

    // chi tiet biet thu
    public function getBietthu(Request $request)
    {
        $id = $request->id;

        $item = Bietthu::with(['images', 'theloai'])
            ->where('id', $id)
            ->first()
            ->toArray();

        $same = Bietthu::with(['image'])
            ->where('theloai_id', $item['theloai_id'])
            ->where('id', '!=', $item['id'])
            ->orderBy('updated_at', 'desc')
            ->limit(8)
            ->get()
            ->toArray();

        return view('frontend::pages.bietthu', compact(['item', 'same']));
    }

    // list biet thu

    public function getThanhpho(Request $request)
    {
        $id = $request->id;

        $parent = Thanhpho::findOrFail($id);
        $ids = Quan::where('thanhpho_id', $id)->get()->pluck('id');
        $items = Bietthu::with(['image'])
            ->whereIn('quan_id', $ids)
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        $trang = [
            'id' => $parent->id,
            'slug' => $parent->slug,
            'title' => $parent->title,
            'route' => 'thanhpho',
        ];

        return $this->returnListBietthu($trang, $items);
    }

    public function getQuanhuyen(Request $request)
    {
        $id = $request->id;
        $parent = Quan::findOrFail($id);
        $items = Bietthu::with(['image'])
            ->where('quan_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        $trang = [
            'id' => $parent->id,
            'slug' => $parent->slug,
            'title' => $parent->title,
            'route' => 'quanhuyen',
        ];

        return $this->returnListBietthu($trang, $items);
    }

    public function getTheloai(Request $request)
    {
        $id = $request->id;
        $parent = Theloai::findOrFail($id);
        $items = Bietthu::with(['image'])
            ->where('theloai_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        $trang = [
            'id' => $parent->id,
            'slug' => $parent->slug,
            'title' => $parent->title,
            'route' => 'quanhuyen',
        ];

        return $this->returnListBietthu($trang, $items);
    }

    public function returnListBietthu($trang, $items)
    {
        return view('frontend::pages.listbietthu', compact(['trang', 'items']));
    }

}
