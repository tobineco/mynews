<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        
        <title>MyProfileNew</title>
    </head>
    <body>
        <h1>Myプロフィール作成画面</h1>
        
    {{-- layouts/profile.blade.phpを読み込む --}}
    @extends('layouts.profile')
        
    {{-- profile.blade.phpの@yield('title')に'プロフィールの新規作成'を埋め込む --}}
    @section('title','プロフィールの新規作成')

    {{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2>プロフィール新規作成</h2>
                     <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                        
                        @if (count($errors) > 0)
                           <ul>
                               @foreach($errors->all() as $e)
                                  <li>{{ $e }}</li>
                               @endforeach
                           </ul>
                        @endif
                        
                        <div class="form-group row">
                            <label class="col-md-2">氏名</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        
                        <!--
                        {{-- 性別の所だけ、ブートストラップ試し --}}
                        <div class="form-group row">
                            <label class="col-md-2">性別</label>
                            <div class="col-md-5">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                   <label class="btn btn-secondary">
                                   <input type="radio" name="options" id="option2"> 男
                                   </label>
                                   <label class="btn btn-secondary">
                                   <input type="radio" name="options" id="option2"> 女
                                   </label>
                                </div>
                            </div>
                        </div>
                        -->
                         
                         <div class="form-group row">
                            <label class="col-md-2">性別</label>
                            <div class="col-md-1">
                                <h4>男</h>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-control" name="gender" value="男">
                            </div>
                            <div class="col-md-1">
                                <h4>女</h>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-control" name="gender" value="女">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">趣味</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="hobby" rows="10">{{ old('hobby') }}</textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2">自己紹介欄</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                            </div>
                        </div>
                        
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                        
                    </form>
                </div>
            </div>
        </div>   
    @endsection
        
    </body>
</html>