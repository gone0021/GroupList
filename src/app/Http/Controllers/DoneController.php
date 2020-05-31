<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoneController extends Controller
{
    public function register()
    {
        $title = __('Register');
        $msg = '登録が完了しました';
        $link =  route('login');
        $disp = 'Login';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function users()
    {
        $title = 'Dashboard';
        $msg = '編集が完了しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function usersPassword()
    {
        $title = 'Dashboard';
        $msg = 'パスワードを変更しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function usersDelete()
    {
        $title = 'Dashboard';
        $msg = 'アカウントを削除しました';
        $link =  url('/');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function group()
    {
        $title = __('Register');
        $msg = '登録が完了しました';
        $title = __('Admin Page');
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }


}
