<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\helpers;

class AdminController extends Controller
{
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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        return view('/admin.index');
    }

    /**
     * ユーザーリスト
     *
     * @return void
     */
    public function user()
    {
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
        }

        $items = User::paginate(helpers::$page);

        $param = ['items' => $items,];
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
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
        }
        $user = User::onlyTrashed()->paginate(helpers::$page);

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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        User::onlyTrashed()->where('id', $req->user_id)->restore();
        return back();
    }

    /**
     * グループの作成：入力
     *
     * @return void
     */
    public function create()
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        return view('/admin.create');
    }

    /**
     * グループの作成：実行
     *
     * @param Request $req
     * @return void
     */
    public function createAdd(GroupRequest $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        $req->session()->pull('group_id');
        $items = Group::paginate(helpers::$page);

        $param = ['items' => $items];
        return view('/admin.list', $param);
    }

    /**
     * グループの編集：入力
     *
     * @param Request $req
     * @return void
     */
    public function edit(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
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
     * グループ編集：実行
     *
     * @param Request $req
     * @return void
     */
    public function groupUpdate(GroupRequest $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        $req->session()->put('group_id', $req->group_id);
        $ses_get = session()->get('group_id');
        // session値からグループを取得
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を配列（コレクション）で取得
        $group_admin = GroupUser::where('group_id', $req->group_id)->where('group_admin', 1)->pluck('user_id');
        // ユーザー情報を取得
        $user = user::whereIn('id', $group_admin)->paginate(helpers::$page);

        $param = [
            'items' => $user,
            'group_id' => $req->group_id,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group_admin', $param);
    }

    /**
     * グループ管理者の追加：選択
     *
     * @param Request $req
     * @return void
     */
    public function addGroupAdmin(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // group_userからグループ管理者以外を配列（コレクション）で取得
        $not_admin = GroupUser::where('group_id', $ses_get)->where('group_admin', 0)->pluck('user_id');
        // G管理者とM管理者以外の情報を取得
        $items = User::whereIn('id', $not_admin)->whereNotIn('is_admin', [1])->paginate(helpers::$page);

        $param = [
            'items' => $items,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        dump($not_admin);
        return view('/admin/group_admin_add', $param);
    }

    /**
     * グループ管理者の追加：実行
     *
     * @param Request $req
     * @return void
     */
    public function addGroupAdminAction(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        $ses_get = session()->get('group_id');

        // group_userからgroup_adminが0を取得してアップデート
        GroupUser::where('group_id', $ses_get)->where('user_id', $req->user_id)->where('group_admin', 0)->update(['group_admin' => 1]);
        // 該当ユーザーをG管理者へアップデート
        User::find($req->user_id)->update(['is_admin' => 2]);

        $req->session()->pull('group_id');

        return redirect('/admin/group_admin/done');
    }

    /**
     * グループ管理者の削除：選択・確認
     *
     * @param Request $req
     * @return void
     */
    public function deleteGroupAdmin(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        $user = User::find($req->user_id);
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
     * グループ管理者の削除：実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteGroupAdminAction(UserRequest $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        // G管理者が1つのみでM管理者でもない場合はis_adminを0へ更新
        if (!helpers::checkAdminNum($req->user_id)) {
            User::find($req->user_id)->update(['is_admin' => 0]);
        }

        // group_userのgroup_adminが1を取得してアップデート
        GroupUser::where('group_id', $req->group_id)->where('user_id', $req->user_id)->where('group_admin', 1)->update(['group_admin' => 0]);

        $req->session()->pull('group_id');
        return redirect('/admin/delete/done');
    }

    /**
     * グループの削除：選択
     *
     * @param Request $req
     * @return void
     */
    public function delete(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
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
     * パスワードによるチェック
     *
     * @return void
     */
    public function fort()
    {
        // $ses_get = $req->session()->get('group_id');
        return view('/admin.fort');
    }

    /**
     * グループの削除：実行
     *
     * @param Request $req
     * @return void
     */
    public function deleteAction(UserRequest $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        $ses_get = session()->get('group_id');
        // 値の削除
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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        // deleted_atのカラムを取得
        $teims = Group::onlyTrashed()->paginate(helpers::$page);

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
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        // deleted_atのカラムを復元
        Group::onlyTrashed()->where('id', $req->group_id)->restore();

        return back();
    }


    // ------ group page ------

    /**
     * 管理グループ一覧
     *
     * @return void
     */
    public function groupIndex()
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        // グループ管理者の場合
        if (helpers::checkGroupAdmin()) {
            // グループ管理者のidを取得して配列（コレクション）で出力
            $g_admin = helpers::getGroupAdminUser()->pluck('group_id');
            $items = Group::whereIn('id', $g_admin)->paginate(helpers::$page);
            // マスタ管理者の場合
        } else if (Auth::user()->is_admin == 1) {
            $items = Group::paginate(helpers::$page);
        }

        $param = ['items' => $items];
        return view('/admin/group.index', $param);
    }

    /**
     * 管理グループ：ユーザー一覧
     *
     * @param Request $req
     * @return void
     */
    public function groupUser(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }

        $req->session()->put('group_id', $req->group_id);
        // 削除でbackがあるためsessionで値を取得
        $ses_get = session()->get('group_id');
        // グループ名を取得するためにグループをidから検索
        $group = Group::find($ses_get);
        $user_list = Group::find($ses_get)->user()->paginate(helpers::$page);

        if (!helpers::checkMasterAdmin()) {
            // グループ管理者のidを取得
            $g_admin = helpers::getGroupAdminUser();
            foreach ($g_admin as $ga) {
                if ($ga->group_id == $ses_get) {
                    $param = [
                        'items' => $user_list,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.user', $param);
                }
            }
            return redirect('/admin/error');
        }

        $param = [
            'items' => $user_list,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.user', $param);
    }


    /**
     * 管理グループ：ユーザーの追加：未参加ユーザーリスト
     *
     * @param Request $req
     * @return void
     */
    public function addUser(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
        }
        $req->session()->put('group_id', $req->group_id);

        $ses_get = session()->get('group_id');
        $group = Group::find($ses_get);

        // グループに属するユーザーidを取得してを配列（コレクション）で出力
        $user_in_group = Group::find($req->group_id)->user()->pluck('id');
        // グループに所属していないユーザー情報の取得
        $user_not = User::whereNotIn('id', $user_in_group)->paginate(helpers::$page);

        if (!helpers::checkAdmin()) {
            // グループ管理者のidを取得
            $g_admin = helpers::getGroupAdminUser();
            foreach ($g_admin as $ga) {
                if ($ga->group_id == $req->group_id) {
                    $param = [
                        'items' => $user_not,
                        'ses_group_id' => $ses_get,
                        'group_name' => $group->group_name,
                    ];
                    return view('/admin/group.add', $param);
                }
            }
            return redirect('/admin/error');
        }

        $param = [
            'items' => $user_not,
            'ses_group_id' => $ses_get,
            'group_name' => $group->group_name,
        ];
        return view('/admin/group.add', $param);
    }

    /**
     * 管理グループ：ユーザーの追加：実行
     *
     * @param Request $req
     * @return void
     */
    public function addAction(Request $req)
    {
        if (!helpers::checkAdmin()) {
            return redirect('/admin/error');
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
        if (!helpers::checkMasterAdmin()) {
            return redirect('/admin/error');
        }

        $ses_get = session()->get('group_id');

        if (!helpers::checkAdminNum($req->user_id)) {
            User::find($req->user_id)->update(['is_admin' => 0]);
        }

        GroupUser::where('group_id', $ses_get)->where('user_id', $req->user_id)->delete();

        return back();
    }
}
