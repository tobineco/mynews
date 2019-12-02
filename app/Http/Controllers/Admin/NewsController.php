<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでNews Modelが扱えるようになる
use App\News;


class NewsController extends Controller
{
    //以下を追記
   public function add()
   {
       return view('admin.news.create');
   }

   //以下を追記
   public function create(Request $request)
   {
       // 以下を追記
       // Validationを行う
       $this->validate($request, News::$rules);

       $news = new News;
       $form = $request->all();

       // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
       if (isset($form['image'])) {
           $path = $request->file('image')->store('pubic/image');
           $news->image_path = basename($path);
       } else {
           $news->image_path = null;
       }
   
       // フォームから送信されてきた _token を削除する
       unset($form['_token']);
       // フォームから送信されてきた image を削除する
       unset($form['image']);
   
       // データベースに保存する
       $news->fill($form);
       $news->save(); 
      
       // admin/news/create にリダイレクトする
       return redirect('admin/news/create');
   }
}