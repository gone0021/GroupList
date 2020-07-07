<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

class AdminController extends Controller
{
    /** ぺジネーションの数 */
    private $page = 7;

    /************************\
    --- 自作メソッド ---
    \************************/

    /**
     * マスター管理者のチェック
     *
     * @return boolean
     */
    public function checkMasterAdmin(): bool
    {
        if (Auth::user()->is_admin != 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *グループー管理者のチェック
     *
     * @return boolean
     */
    public function checkGroupAdmin(): bool
    {
        if (Auth::user()->is_admin != 2) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 管理者のチェック
     *
     * @return boolean
     */
    public function checkAdmin(): bool
    {
        if (!$this->checkMasterAdmin() && !$this->checkGroupAdmin()) {
            // if (Auth::user()->is_admin != 1 && Auth::user()->is_admin != 2) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * グループ管理者の取得
     * group_adminより
     *
     * @return object
     */
    public function getGroupAdminUser()
    {
        $a_id = Auth::id();
        $gu_admin = GroupUser::where('user_id', $a_id)->where('group_admin', 1)->get();
        return $gu_admin;
    }

    /**
     * グループ管理者の個とマスター管理者をチェック
     * users
     *
     * @return boolean
     */
    public function checkAdminNum($var): bool
    {
        $g_admin = GroupUser::where('user_id', $var)->where('group_admin', 1)->pluck('group_admin');
        $count = $g_admin->count();
        $admin = User::find($var);

        if ($count <= 1 && $admin->is_admin != 1) {
            return false;
        } else {
            return true;
        }
    }

    /************************\
    --- admin ---
    \************************/

    /**
     * エラーページ
     *
     * @return void
     */
    public function error()
    {
        return view('/admin.error');
    }

    /**
     * 管理者ページ
     *
     * @return void
     */
    public function index()
    {
        if (!$this->checkAdmin()) {
            dump($this->checkAdmin());
            return view('/admin.error');
        }

        return view('/admin.index');
    }

    /**
     * 管理者ページ
     *
     * @return void
     */
    public function user()
    {
        // $this->checkMasterAdmin();
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }

        $items = User::paginate($this->page);

        $param = [
            'items' => $items,
        ];
        return view('/admin.user', $param);
    }

    /**
     * ユーザー情報の確認
     *
     * @param Request $req
     * @return void
     */
    public function userShow(Request $req)
    {
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }
        $items = User::find($req->user_id);

        $param = [
            'items' => $items,
            'title' => __('User Page'),
            'user_name' => $items->user_name,
        ];
        return view('/admin.user_show', $param);
    }

    /**
     * ユーザーの参加グループ
     *
     * @param Request $req
     * @return void
     */
    public function userGroup(Request $req)
    {
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }
        $user = User::find($req->user_id);
        $group = User::find($req->user_id)->group()->get();

        $param = [
            'items' => $group,
            'user_name' => $user->user_name,
        ];
        return view('/admin.user_group', $param);
    }

    /**
     * ユーザーの削除
     * 仮の機能で本番では使わない
     *
     * @param Request $req
     * @return void
     */
    public function userDel(Request $req)
    {
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }
        User::find($req->user_id)->delete();
        return back();
    }

    /**
     * 削除済ユーザーの確認
     *
     * @return void
     */
    public function deletedUser()
    {
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }
        $user = User::onlyTrashed()->paginate($this->page);

        $param = ['items' => $user];
        return view('/admin.user_deleted', $param);
    }

    /**
     * 削除済ユーザーの復元
     *
     * @param Request $req
     * @return void
     */
    public function userRestore(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        User::onlyTrashed()->where('id', $req->user_id)->restore();
        return back();
    }

    /**
     * グループの作成
     * 入力
     *
     * @return void
     */
    public function create()
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        return view('/admin.create');
    }

    /**
     * グループの作成
     * 実行
     *
     * @param Request $req
     * @return void
     */
    public function createAdd(GroupRequest $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $val = $req->all();
        unset($val['_token']);

        $groups = new Group;
        $groups->fill($val)->save();

        return redirect('/admin/create/done');
    }

    /**
     * グループの一覧
     *
     * @param Request $req
     * @return void
     */
    public function list(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }

        $req->session()->pull('group_id');
        $group = Group::paginate($this->page);

        $param = ['items' => $group];
        return redirect('/admin/list', $param);
    }

    /**
     * グループの編集
     * 入力
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $val = Group::find($req->group_id);

        $param = [
            'id' => $req->group_id,
            'group_name' => $val->group_name,
            'group_type' => $val->group_type,
        ];
        return view('/admin.edit', $param);
    }

    /**
     * グループ編集
     * 実行
     *
     * @param Request $req
     * @return void
     */
    public function groupUpdate(GroupRequest $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $val = $req->all();
        unset($val['_token']);

        $group = Group::find($req->id);
        $group->fill($val)->update();

        return redirect('/admin/edit/done');
    }


    /**
     * グループ管理者
     *
     * @param Request $req
     * @return void
     */
    public function groupAdmin(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        // sessionの保存と取得
        $req->session()->put('group_id', $req->group_id);
        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者を取得して配列へ
        $group_admin = GroupUser::where('group_id', $req->group_id)->where('group_admin', 1)->pluck('user_id');
        // ユーザー情報を取得
        $user = user::whereIn('id', $group_admin)->paginate($this->page);

        $param = [
            'items' => $user,
            'group_id' => $req->group_id,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin', $param);
    }

    /**
     * グループ管理者の追加
     * 選択
     *
     * @param Request $req
     * @return void
     */
    public function addGroupAdmin(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を取得して配列へ
        $not_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 0)->pluck('user_id');
        // G管理者とM管理者以外の情報を取得
        $items = User::whereIn('id', $not_admin)->whereNotIn('is_admin', [1])->paginate($this->page);

        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin_add', $param);
    }

    /**
     * グループ管理者の追加
     * 実行
     *
     * @param Request $req
     * @return void
     */
    public function addGroupAdminAction(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $ses_get =session()->get('group_id');

        GroupUser::where('group_id', $ses_get)->where('user_id', $u_id)->where('group_admin', 0)->update(['group_admin' => 1]);
        User::find($u_id)->update(['is_admin' => 2]);

        $req->session()->pull('group_id');

        return redirect('/admin/group_admin/done');
    }

    /**
     * グループ管理者の削除 / 選択・確認
     *
     * @param Request $req
     * @return void
     */
    public function deleteGroupAdmin(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $u_id = $req->user_id;
        $user = User::find($u_id);
        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        $param = [
            "user" => $user,
            "user_id" => $user->id,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin.group_admin_delete', $param);
    }

    /**
     * グループ管理者の削除_実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteGroupAdminAction(UserRequest $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }

        if (!$this->checkAdminNum($req->user_id)) {
            User::find($req->user_id)->update(['is_admin' => 0]);
        }

        GroupUser::where('group_id', $req->group_id)->where('user_id', $req->user_id)->where('group_admin', 1)->update(['group_admin' => 0]);

        $req->session()->pull('group_id');

        return redirect('/admin/delete/done');
    }

    /**
     * グループの削除_選択
     *
     * @param Request $req
     * @return void
     */
    public function delete(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $req->session()->put('group_id', $req->group_id);
        $group = Group::find($req->group_id);

        $param = [
            'id' => $group->id,
            "group_name" => $group->group_name,
        ];
        return view('/admin.delete', $param);
    }

    /**
     * パスワードによる確認
     *
     * @return void
     */
    public function fort()
    {
        // $ses_get = $req->session()->get('group_id');
        return view('/admin.fort');
    }

    /**
     * グループの削除 実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteAction(UserRequest $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $ses_get = session()->get('group_id');

        Group::find($ses_get)->delete();
        GroupUser::where('group_id', $ses_get)->delete();
        $req->session()->pull('group_id');

        return redirect('/admin/delete/done');
    }

    /**
     * 削除済グループの表示
     *
     * @return void
     */
    public function deletedGroup()
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $teims = Group::onlyTrashed()->paginate($this->page);

        $param = ['items' => $teims];
        return view('/admin.group_deleted', $param);
    }

    /**
     * 削除済グループの復元
     *
     * @param Request $req
     * @return void
     */
    public function groupRestore(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        Group::onlyTrashed()->where('id', $req->group_id)->restore();

        return back();
    }

    /************************\
    --- group ---
    \************************/

    /**
     * 管理グループ一覧
     *
     * @return void
     */
    public function groupIndex()
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }

        if ($this->checkGroupAdmin()) {
            $admin_user = $this->getGroupAdminUser()->pluck('group_id');
            $items = Group::whereIn('id', $admin_user)->paginate($this->page);
        } else if (Auth::user()->is_admin == 1) {
            $items = Group::paginate($this->page);
        }

        $param = ['items' => $items];

        // dump($admin_user);
        // return view('test');
        return view('/admin/group.index', $param);
    }

    /**
     * 管理グループ
     * ユーザー一覧
     *
     * @param Request $req
     * @return void
     */
    public function groupUser(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }

        $req->session()->put('group_id', $req->group_id);
        $ses_get = session()->get('group_id');

        $user_list = Group::find($ses_get)->user()->paginate($this->page);
        $group = Group::find($ses_get);

        if (!$this->checkMasterAdmin()) {
            $gu_admin = $this->getGroupAdminUser();
            foreach ($gu_admin as $ga) {
                if ($ga->group_id == $ses_get) {
                    $param = [
                        'items' => $user_list,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.user', $param);
                }
            }
            return view('/admin.error');
        }

        $param = [
            'items' => $user_list,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.user', $param);
    }


    /**
     * 管理グループ
     * ユーザーの追加_未参加ユーザーリスト
     *
     * @param Request $req
     * @return void
     */
    public function addUser(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $req->session()->put('group_id', $req->group_id);

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // groupsとusersを結合してグループに属するユーザーを取得して配列へ
        $user_in_group = Group::find($req->group_id)->user()->pluck('id');
        // グループに所属していないユーザー情報の取得
        $user_not = User::whereNotIn('id', $user_in_group)->paginate($this->page);

        if (!$this->checkAdmin()) {
            $gu_admin = $this->getGroupAdminUser();
            foreach ($gu_admin as $ga) {
                if ($ga->group_id == $req->group_id) {
                    $param = [
                        'items' => $user_not,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.add', $param);
                }
            }
            return view('/admin.error');
        }

        $param = [
            'items' => $user_not,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.add', $param);
    }

    /**
     * 管理グループ
     * ユーザーの追加_実行
     *
     * @param Request $req
     * @return void
     */
    public function addAction(Request $req)
    {
        if (!$this->checkAdmin()) {
            return view('/admin.error');
        }
        $ses_get = session()->get('group_id');

        $gu = new GroupUser;
        $gu->user_id = $req->user_id;
        $gu->group_id = $ses_get;
        $gu->group_admin = 0;
        $gu->save();

        return redirect('/admin/create/done');
    }

    /**
     * ユーザーの削除
     * 仮の機能で本番では使わない
     *
     * @param Request $req
     * @return void
     */
    public function groupUserDel(Request $req)
    {
        if (!$this->checkMasterAdmin()) {
            return view('/admin.error');
        }

        $ses_get = session()->get('group_id');

        if (!$this->checkAdminNum($req->user_id)) {
            User::find($req->user_id)->update(['is_admin' => 0]);
        }

        GroupUser::where('group_id', $ses_get)->where('user_id', $req->user_id)->delete();

        return back();
    }
}
