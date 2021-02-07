<?php

namespace App\Http\Controllers;

use App\Facades\Calendar;
use App\Services\CalendarService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Group;
use App\Models\Item;

class CalendarController extends Controller
{
    private $service;

    public function __construct(CalendarService $service)
    {
        $this->service = $service;
    }

    public function index(Request $req)
    {
        $a_id = Auth::id();
        $groups = User::find($a_id)->group()->get();

        if(empty($req->group_id)) {
            $req->group_id = 0;
        }
        if(empty($req->item_type)) {
            $req->item_type = 0;
        }

        $param = [
            'group_id' => $req->group_id,
            'item_type' => $req->item_type,
            'groups' => $groups,
            'lists' => array("全て", "ダイビング", "場所", "予定", ),
            'titles' => array("日", "月", "火", "水", "木", "金", "土"),
            'weeks' => Calendar::getWeeks($req->group_id, $req->item_type),
            'month' => Calendar::getMonth(),
            'dispMonth' => Calendar::getDisplayMonth(),
            'thisMonth' => Calendar::getThisMonth(),
            'prev' => Calendar::getPrev(),
            'next' => Calendar::getNext(),
        ];

        // dump($req->group_id);
        // dump($req->item_type);
        // dump($groups);
        // return view('sql', $param);
        return view('/items.calendar', $param);
    }
}
