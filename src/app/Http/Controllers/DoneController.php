<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoneController extends Controller
{
    /**
     * 新規登録
     * 
     * @return void
     */
    public function register()
    {
        $title = __('Register Completed');
        $msg = '登録が完了しました';
        $link =  route('login');
        $disp = 'Login';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * ユーザー情報の編集
     * 
     * @return void
     */
    public function usersEdit()
    {
        $title = __(' Edit Completed');
         $msg = '編集が完了しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * パスワードの変更
     * 
     * @return void
     */
    public function usersPassword()
    {
        $title = __(' Edit Password Completed');
        $msg = 'パスワードを変更しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * ユーザーの削除
     * 
     * @return void
     */
    public function usersDelete()
    {
        $title = __(' Delete Account Completed');
        $msg = 'アカウントを削除しました';
        $link =  url('/');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * グループの脱退
     * 
     * @return void
     */
    public function usersLeave()
    {
        $title = __(' Leave Group Completed');
        $msg = '脱退が完了しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * グループの作成
     * 
     * @return void
     */
    public function adminCreate()
    {
        $title = __(' New Group Completed');
        $msg = '登録が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * グループの編集
     * 
     * @return void
     */
    public function adminEdit()
    {
        $title = __(' Edit Group Completed');
        $msg = '更新が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * グループ管理者の追加
     * 
     * @return void
     */
    public function adminGroupAdminAdd()
    {
        $title = __(' Add Admin Completed');
        $msg = '登録が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * グループの削除
     * 
     * @return void
     */
    public function adminDelete()
    {
        $title = __(' Derlete Group Completed');
        $msg = 'グループを削除しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }

    /**
     * ユーザーの追加
     * 
     * @return void
     */
    public function groupAddUser()
    {
        $title = __(' Add User Completed');
        $msg = 'ユーザーを追加しました';
        $link =  route('group');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/assist.done', $param);
    }
}
