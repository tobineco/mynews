<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;

// Profilehistoryモデルの使用を宣言＆Carbonライブラリ使用を宣言
use App\Profilehistory;
use Carbon\Carbon;

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

    public function edit(Request $request)
    {
        // Profile Model からデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form'=>$profile]);
    }

    public function update(Request $request)
    {
        // Validation をかける
        $this->validate($request, Profile::$rules);
        
        // 送信されてきたフォームデータを格納する（順を前に）
        $profile_form = $request->all(); 
        
        // Profile Model からデータを取得する(亀山メンター指示)
        $profile = Profile::find($profile_form->id);
       
        // Profile Model からデータを取得する(元々記述？404) 
        // $profile = Profile::find($request->id);
        
        unset($profile_form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        // Profileモデルを保存するタイミングで、Profilehistoryモデルにも
        // 編集履歴を追加するように実装
        $profilehistory = new Profilehistory;
        $profilehistory->profile_id = $profile->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();
        
        return redirect('admin/profile/edit');
    }

}