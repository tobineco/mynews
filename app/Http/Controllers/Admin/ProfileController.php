<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    //以下を追記
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
       // 以下を追記
       // Validationを行う
       $this->validate($request, Profile::$rules);

       $profile = new Profile;
       $form = $request->all();
   
       // フォームから送信されてきた _token を削除する
       unset($form['_token']);
   
       // データベースに保存する
       $profile->fill($form);
       $profile->save();
        
        return redirect('admin/profile/create');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }

}
