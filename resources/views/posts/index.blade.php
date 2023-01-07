@extends('layouts.basic')

@section('content')
    {{-- <style>
        .card {
            background-color: #a8a8a8;
            color: black;
            width: 50%;
            text-align: center;
            font-family: Helvetica, Arial, sans-serif;
            font-weight: bold;
            cursor: pointer;
            position: relative;
        }
        
        .link {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }
    </style> --}}
    <div class="container-lg p-5">
    
        @if (session('message'))
            <p> {{ session('message') }} </p>
        @endif
    
        <ul>
            @foreach($posts as $post)
    
            <div class="container">
                <div class="card shadow p-1 mb-3 bg-white rounded" style="width: 50%; margin:auto;">
                    <div class="card-body">
                        @inject('time', 'App\Http\Controllers\TimeElapsed')
                        <div class="card-title" style="font-weight: bold;">{{$users[$post->user_id-1]->name}} | {{$users[$post->user_id-1]->email}}</div>
                        <p class="card-text">{{$post->caption}}</p>
                        <p class="card-text" style="text-align: right;"><small>{{ $time::time_elapsed_string($post->created_at) }}</small></p>
                    </div>
                    @if($post->image != NULL)
                        <div class="card-img-bottom">
                            <img src=" {{ asset('storage/images/'. $post->image) }} " alt="Image posted by {{$users[$post->user_id-1]->name}}" class="img-fluid p-3 pt-0">
                        </div>
                    @endif
                    <a href=" {{ route('show', ['id' => $post->id]) }}" ><span class="stretched-link"></span></a>
                </div>
                
                <div style="height: 1cm;">
                </div>

            </div>
            
    
            @endforeach
        </ul>
    </div>

@endsection