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
        
        return redirect('admin/profile/');
    }
    
    public function index(Request $request)
    {
        $input_name = $request->input_name;
        if ($input_name != '') {
            $posts = Profile::where('name', $input_name)->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts'=>$posts, 'input_name'=>$input_name]);
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
        
        // Profile Model　からデータを取得する（）
        $profile = Profile::find($request->id);
        
        // 送信されてきたフォームデータを格納する（）
        $profile_form = $request->all(); 
        
        unset($profile_form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        // Profileモデルを保存するタイミングで、Profilehistoryモデルにも
        // 編集履歴を追加するように実装
        $profilehistory = new Profilehistory;
        $profilehistory->profile_id = $profile->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();
        
        return redirect('admin/profile/');
    }
    
    public function delete(Request $request)
    {
        // 該当するProfile Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profile/');
    }

}