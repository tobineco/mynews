<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        
        <title>MyProfileEdit</title>
    </head>
    <body>
        <h1>Myプロフィール編集画面</h1>
        
    {{-- layouts/profile.blade.phpを読み込む --}}
    @extends('layouts.profile')
        
    {{-- profile.blade.phpの@yield('title')に'プロフィールの編集'を埋め込む --}}
    @section('title','プロフィールの編集')

    {{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2>プロフィール編集</h2>
                     <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                        
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
                                <input type="text" class="form-control" name="name" value="{{ old('name', $profile_form['name']) }}">
                            </div>
                        </div>
                        
                        <!-- {{ $profile_form }} -->
                        
                        <!--
                        {{-- 性別の所だけ、ブートストラップ試し --}}
                        <div class="form-group row">
                            <label class="col-md-2">性別</label>
                            <div class="col-md-5">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                   <label class="btn btn-secondary">
                                   <input type="radio" name="gender" id="dansei" value='male' {{ old('gender', $profile_form->gender) == 'male' ? 'checked' : '' }} > 男
                                   </label>
                                   <label class="btn btn-secondary">
                                   <input type="radio" name="gender" id="josei" value='female' {{ old('gender', $profile_form->gender) == 'female' ? 'checked' : '' }}> 女
                                   </label>
                                   
                                   ★<input type="radio" name="like" id="apple" value='apple' {{ old('like','apple') == 'apple' ? 'checked' : '' }}>
                                   
                                </div>
                            </div>
                        </div>
                        -->
                        
                         
                         {{-- 性別の所、結局ブートストラップ無しのHTMLラジオボタンに戻す --}}
                         <div class="form-group row">
                            <label class="col-md-2">性別</label>
                            <div class="col-md-1">
                                <h4>男</h>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-control" name="gender" value="male" {{ old('gender', $profile_form->gender) == 'male' ? 'checked' : '' }} >
                            </div>
                            <div class="col-md-1">
                                <h4>女</h>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-control" name="gender" value="female" {{ old('gender', $profile_form->gender) == 'female' ? 'checked' : '' }} >
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label class="col-md-2">趣味</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="hobby" rows="10">{{ old('hobby', $profile_form['hobby']) }}</textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2">自己紹介欄</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="introduction" rows="20">{{ old('introduction', $profile_form['introduction']) }}</textarea>
                            </div>
                        </div>
                        
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                        
                    </form>
                    
                    {{-- 記録したProfile変更履歴を参照できるようにする --}}
                    {{-- <div class="row mt-5">
                        <div class="col-md-4 mx-auto">
                            <h2>編集履歴</h2>
                            <ul class="list-group">
                                @if ($profile_form->profilehistories != NULL)
                                    @foreach ($profile_form->histories as $history)
                                        <li class="list-group-item">{{ $profilehistory->edited_at }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    --}}
                    
                </div>
            </div>
        </div>   
    @endsection
        
    </body>
</html>