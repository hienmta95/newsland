<?php

namespace Modules\Frontend\Http\Controllers;

use App\Theloai;
use App\Tintuc;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Slide;
use App\Noithat;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $slide = Slide::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();

        $tintuc = Tintuc::with(['image'])
            ->orderBy('updated_at', 'desc')
            ->limit(4)
            ->get()
            ->toArray();

        $theloai = Theloai::with(['bietthu' => function($q) {
            $q->with(['image'])
            ->limit(8)
            ->orderBy('updated_at', 'desc');
        }])
            ->orderBy('order', 'asc')
            ->get()
            ->toArray();

        $video = Video::orderBy('updated_at', 'desc')
            ->limit(8)
            ->get()
            ->toArray();

        return view('frontend::pages.trangchu', compact(['slide', 'theloai', 'tintuc', 'video']));
    }

}
