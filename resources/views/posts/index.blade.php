@extends('layouts.basic')

@section('content')

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
                        <div class="card-title" style="font-weight: bold;">
                            <a href="{{route('getProfile', ['id' => $post->id])}}"> {{$users[$post->user_id-1]->name}} </a>
                        </div>
                        <div style="position: relative;">
                            <p class="card-text">{{$post->caption}}</p>
                            <p class="card-text" style="text-align: right;"><small>{{ $time::time_elapsed_string($post->created_at) }}</small></p>
                            @if($post->image != NULL)
                            <div class="card-img-bottom">
                                <img src=" {{ asset('storage/images/'. $post->image) }} " alt="Image posted by {{$users[$post->user_id-1]->name}}" class="img-fluid pt-0">
                            </div>
                            @endif
                            <a href=" {{ route('show', ['id' => $post->id]) }}" ><span class="stretched-link"></span></a>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div style="height: 1cm;">
                </div>

            </div>
            
    
            @endforeach
        </ul>

        {{$posts->links()}}
        <style>
            ul.pagination {
                position: absolute;
                left: 47%;
            }
        </style>
    </div>

@endsection