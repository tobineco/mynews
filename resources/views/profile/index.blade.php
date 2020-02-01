<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        
        <title>MyProfileFront</title>
    </head>
    <body>
        <h2>Myプロフィール★フロント画面</h2>
            
    {{-- layouts/front.blade.phpを読み込む --}}
    @extends('layouts.front')
    
    @section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row bg-info py-3">
                <div class="headline col-md-10 mx-auto"> 
                    <div class="row py-3">
                        <div class="col-2 bg-secondary text-center py-3">名前</div>
                        <div class="col-5 bg-white py-3">{{ $headline->name }}</div>
                    </div>
                    <div class="row py-3">
                        <div class="col-2 bg-secondary text-center py-3">趣味</div>
                        <div class="col-10 bg-white py-3">{{ $headline->hobby }}</div>
                    </div>    
                    <div class="row py-3">    
                        <div class="col-2 bg-secondary text-center py-3">自己紹介</div>
                        <div class="col-10 bg-white py-3">{{ $headline->introduction }}</div>
                    </div>
                    <div class="row text-center py-3">
                        <div class="col-2 bg-secondary text-center py-3">性別</div>
                        <div class="col-1 bg-white py-3">{{ $headline->gender }}</div>  
                        <div class="col-2 bg-secondary text-center py-3">更新日</div>
                        <div class="col-3 bg-white py-3">{{ $headline->updated_at->format('Y年m月d日') }}</div>
                    </div>
                </div>
            </div>
        @endif
                      
        <hr color="#c0c0c0">
    @endsection
        
    </body>
</html>