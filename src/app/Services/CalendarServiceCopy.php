<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use DateTime;
use Illuminate\Support\Facades\DB;
use Yasumi\Yasumi;

class CalendarService
{
    /**
     * カレンダーデータを返却する
     *
     * @return array
     */
    public function getWeeks()
    {
        // 出力する値
        $weeks = [];
        $week = '';

        // カレンダーの作成
        // $dt = new Carbon(self::getYm_firstday());
        $dt = new Carbon(self::getYm_firstday());
        $day_of_week = $dt->dayOfWeek; // 曜日
        $days_in_month = $dt->daysInMonth; // その月の日数

        // 祝日の取得用
        $month = Carbon::parse(self::getYm_firstday())->format('Y');
        $holidays = Yasumi::create('Japan', $month, 'ja_JP');
        $holidayNname = $this->getHoliday($dt);
        $holiday = '';

        // dbアイテムの取得
        $saerchA = $this->searchA();
        $item = '';

        // $a = $this->searchItemsMineAllType();
        $b = $this->searchItemsMineByType(2)->first();



        // 1週目に空のセルを追加
        $week .= str_repeat('<td></td>', $day_of_week);

        // 7日分（日～土）のループ
        for ($day = 1; $day <= $days_in_month; $day++, $day_of_week++) {
            // $date = self::getYm() . '-' . date('j',$day);
            $date = self::getYm() . '-' . $day;
            $dateTime = new DateTime($date);

            // 祝日の有無と祝日名の取得
            foreach ($holidayNname as $k => $v) {
                if ($k == $dateTime->format('Y-m-d')) {
                    $holiday = $v;
                    break;
                } else {
                    $holiday = '';
                }
            }

            // dbアイテムの有無とtitleの取得
            foreach ($saerchA as $k => $v) {
                if ($k == $dateTime->format('Y-m-d')) {
                    $item = $v;
                    break;
                } else {
                    $item = '';
                }
            }
            // dump($dateTime->format('Y-m-d'));
            // dump($v);

            // 当日ならclassにtodayを設定
            if (Carbon::now()->format('Y-m-j') === $date) {
                // 祝日にholidayを設定
                if (empty($holidays->isHoliday($dateTime))) {
                    $week .= '<td class="today">' . $day . $item;
                } else {
                    $week .= '<td class="today">' . $day . '<br>' . $holiday . '<br>' . $item;
                }
                // classにcldを設定
            } else {
                // 祝日にholidayを設定
                if ($holidays->isHoliday($dateTime)) {
                    $week .= '<td class="cld holiday">' . $day . '<br>' . $holiday . $item;
                    // classにcldを設定
                } else {
                    $week .= '<td class="cld">' . $day . '<br>' . $item;
                }
            }
            // 出力
            $week .= '</td>';
            // }

            // 週の終わりの改行、または月末の改行と空白tdタグ
            if (($day_of_week % 7 === 6) || ($day === $days_in_month)) {
                // 月末の空白tdタグ
                if ($day === $days_in_month) {
                    $week .= str_repeat('<td></td>', 6 - ($day_of_week % 7));
                }
                // 出力
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }
        }


        if ($this->getMonthCheck() == date('Y-m', strtotime($b->date))) {
            if ($date == date('j',  strtotime($b->date)))
                echo 'a';
        }

        dump($saerchA);
        echo '<br>';

        // dump($holidayNname);

        // dump($name);

        return $weeks;
    }

    /**
     * 祝日名の取得
     *
     * @return string
     */
    // 祝日名の取得
    function getHolidayNmae(DateTime $month, String $date): string
    {
        $holidays = Yasumi::create('Japan', (int)$month->format('Y'), 'ja_JP');
        $results  = [];
        foreach ($holidays->getHolidays() as $holiday) {
            $results[$holiday->format('Y-m-j')] = $holiday->getName();
        }
        return $results[$date];
    }

    function getHoliday(DateTime $month): array
    {
        $holidays = Yasumi::create('Japan', (int)$month->format('Y'), 'ja_JP');
        $results  = [];
        foreach ($holidays->getHolidays() as $holiday) {
            $results[$holiday->format('Y-m-d')] = $holiday->getName();
        }
        return $results;
    }

    /**
     * selectする値をフィールドにセット
     */
    public $select = ["item_id", "item_type", "title", "date", "uid", "status"];

    /**
     * items 該当日のアイテム数を取得（個人：全て）
     *
     * @return object
     */
    public function searchItemsMineAllType($date)
    {
        $a_id = Auth::id();

        $serch = DB::raw(Item::unionNoGroup());

        $imtes = DB::table($serch)
            ->select($this->select)
            ->where('uid', $a_id)
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->title;
        }

        return $results[$date];
    }

    public function searchA()
    {
        $a_id = Auth::id();

        $serch = DB::raw(Item::unionNoGroup());

        $imtes = DB::table($serch)
            ->select($this->select)
            ->where('uid', $a_id)
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->title;
        }

        return $results;
    }


    /**
     * items 該当日のアイテム数を取得（個人：タイプ別）
     *
     * @return object
     */
    public function searchItemsMineByType(String $item_type)
    {
        $a_id = Auth::id();

        $serch = DB::raw(Item::unionNoGroup());

        $imtes = DB::table($serch)
            ->select($this->select)
            ->where('item_type', $item_type)
            ->where('uid', $a_id)
            ->get();

        return $imtes;
    }

    /**
     * items 該当日のアイテム数を取得（グループごと：全て）
     *
     * @return object
     */
    public function searchItemsGroupAllType(String $group_id, String $item_type)
    {
        $a_id = Auth::id();

        $serch = DB::raw(Item::unionNoGroup());

        $imtes = DB::table($serch)
            ->select($this->select)
            ->where('group_id', $group_id)
            ->get();

        return $imtes;
    }

    /**
     * items 該当日のアイテム数を取得（グループごと：タイプ別）
     *
     * @return object
     */
    public function searchItemsGroupByType(String $group_id, String $item_type)
    {
        $a_id = Auth::id();

        $serch = DB::raw(Item::unionNoGroup());

        $imtes = DB::table($serch)
            ->select($this->select)
            ->where('group_id', $group_id)
            ->where('item_type', $item_type)
            ->get();

        return $imtes;
    }


    /**
     * month 文字列を返却する
     *
     * @return string
     */
    public function getMonth()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y年n月');
    }

    /**
     * month 年月のチェック用の文字列を返却する
     *
     * @return string
     */
    public function getMonthCheck()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y-m');
    }

    /**
     * prev 文字列を返却する
     *
     * @return string
     */
    public function getPrev()
    {
        return Carbon::parse(self::getYm_firstday())->subMonthsNoOverflow()->format('Y-m');
    }

    /**
     * next 文字列を返却する
     *
     * @return string
     */
    public function getNext()
    {
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow()->format('Y-m');
    }

    /**
     * GET から Y-m フォーマットを返却する
     *
     * @return string
     */
    private static function getYm()
    {
        if (isset($_GET['ym'])) {
            return $_GET['ym'];
        }
        return Carbon::now()->format('Y-m');
    }

    /**
     * 2019-09-01 のような月初めの文字列を返却する
     *
     * @return string
     */
    private static function getYm_firstday()
    {
        return self::getYm() . '-01';
    }
}
