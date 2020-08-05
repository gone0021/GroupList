<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use App\Calendar;


class CalendarController2 extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // indexでカレンダーデータ機能取得
    public function index(Request $request)
    {
        $itemList = Trip::where('user_id',Auth::user()->id)->get();
        $cal = new Calendar($itemList);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        $param = [
            'titles' => array("日", "月", "火", "水", "木", "金", "土"),
            'cal_tag' => $tag,
        ];
        return view('calendar', $param);
    }
}
