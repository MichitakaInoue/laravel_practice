<!-- register.bladeを修正したもの -->
<!-- 継承 -->


<!-- old'nameの値'でエラーがあっても入力の値を保持-->

@extends('layouts.app')  

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                                            <!-- 翻訳ファイルを元に言語の設定を変えることができる -->
                <div class="card-header">{{ __('Drill Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('drills.create') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <!-- $messageと書いておくだけで、自動的にlaravelからエラーがあっったら自動的にメッセージを入れてくれる -->
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}"  autocomplete="category_name">

                                @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <!-- <div class="form-group row">
                            <label for="problem0" class="col-md-4 col-form-label text-md-right">{{ __('Problem').'1' }}</label>

                            <div class="col-md-6">
                                <input id="problem0" type="text" class="form-control @error('problem0') is-invalid @enderror" name="problem0" value="{{ old('problem0') }}" required autocomplete="problem0">

                                @error('problem0')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="problem1" class="col-md-4 col-form-label text-md-right">{{ __('Problem').'2' }}</label>

                            <div class="col-md-6">
                                <input id="problem1" type="text" class="form-control @error('problem1') is-invaild @enderror" name="problem1" required autocomplete="problem1">
                                @error('problem1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->


                        <!-- 入力項目を10個ループさせる-->
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="form-group row">
                                <label for="problem{{$i-1}}" class="col-md-4 col-form-label text-md-right">{{ __('Problem').$i }}</label>

                                <div class="col-md-6">
                                    <input id="problem{{$i-1}}" type="text" class="form-control @error('problem'.($i-1)) is-invalid @enderror" name="problem{{$i-1}}" value="{{old('problem'.($i-1)) }}"  autocomplete="problem{{$i-1}}">
                                    @error('problem'.($i-1))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>  
                        @endfor






                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


 