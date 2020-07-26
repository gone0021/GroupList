<?php

namespace App\Http\Controllers;

use App\Facades\Calendar;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $service;

    public function __construct(CalendarService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $param = [
            'titles' => array("日", "月", "火", "水", "木", "金", "土"),
            'weeks' => Calendar::getWeeks(),
            'month' => Calendar::getMonth(),
            'prev' => Calendar::getPrev(),
            'next' => Calendar::getNext(),
        ];
        return view('/items.calendar',$param );
    }
}
