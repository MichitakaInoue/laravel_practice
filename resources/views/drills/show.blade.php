@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{__('Practice').'['.$drill->title.']'}}
                    </div>
                    <div class="card-body text-center">
                        <p>{{$drill->problem0}}</p>
                        <p>{{$drill->problem1}}</p>
                        <p>{{$drill->problem2}}</p>
                        <div id="app">
                            {{-- これで.vueファイルを読みこむことができる --}}
                            {{-- これらpropsを使って、コンポーネントを流し込んでいる --}}
                            <example-component title="{{__('Practice').'['.$drill->title.']'}}"
                                :drill="{{$drill}}" category_name="{{$drill->category_name}}"></example-component>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection