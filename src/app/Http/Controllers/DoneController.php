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

    public function usersEdit()
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

    public function usersLeave()
    {
        $title = 'Dashboard';
        $msg = '脱退が完了しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function adminCreate()
    {
        $title = __('Admin Page');
        $msg = '登録が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function adminEdit()
    {
        $title = __('Admin Page');
        $msg = '更新が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    public function adminDelete()
    {
        $title = __('Admin Page');
        $msg = 'グループを削除しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }


    public function groupAddUser()
    {
        $title = __('Admin Page');
        $msg = 'ユーザーを追加しました';
        $link =  route('group');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }
}