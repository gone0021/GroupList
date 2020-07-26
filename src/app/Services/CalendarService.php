<?php

namespace App\Services;

use Carbon\Carbon;

class CalendarService
{
    /**
     * カレンダーデータを返却する
     *
     * @return array
     */
    public function getWeeks()
    {
        $weeks = [];
        $week = '';

        $carbon = new Carbon(self::getYm_firstday());
        $day_of_week = $carbon->dayOfWeek;     // 曜日
        $days_in_month = $carbon->daysInMonth; // その月の日数

        // 第1週目に空のセルを追加
        $week .= str_repeat('<td></td>', $day_of_week);

        // テーブルの作成
        for ($day = 1; $day <= $days_in_month; $day++, $day_of_week++) {
            $date = self::getYm() . '-' . $day;
            // 日付の出力
            if (Carbon::now()->format('Y-m-j') === $date) {
                $week .= '<td class="today">' . $day;
            } else {
                $week .= '<td class="cld">' . $day;
            }
            // 出力
            $week .= '</td>';

            // 週の終わり、または月末
            if (($day_of_week % 7 === 6) || ($day === $days_in_month)) {
                if ($day === $days_in_month) {
                    $week .= str_repeat('<td class="cld></td>', 6 - ($day_of_week % 7));
                }
                // 出力
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }
        }
        return $weeks;
    }

    /**
     * items 該当日のアイテムを取得
     *
     * @return mixed
     */
    public function getItems()
    {

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
