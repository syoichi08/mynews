<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

public function create(Request $request)
  {

      // 以下を追記
      // Validationを行う
      $this->validate($request, profile::$rules);
      $profile = new Profile;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $profile->fill($form);
      $profile->save();

      return redirect('admin/profile/create');
  }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        return redirect('admin/profile/edit');
    }
}
