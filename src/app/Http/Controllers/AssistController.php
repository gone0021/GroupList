<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ------
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;

class AssistController extends Controller
{
    public function registerCheck(UserRequest $req)
    {
        $val = $req->all();
        unset($val['_token']);
        unset($val['password_confirmation']);

        $param = $val;
        // dump($param);
        return view('/assist.register_check', $param, );
    }

    public function registerAdd(Request $req)
    {
        $users = new User;
        $val = $req->all();
        $val['password'] = Hash::make($val['password']);
        unset($val['_token']);

        $users->fill($val)->save();
        return redirect('/register_done');
    }
}
