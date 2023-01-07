@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')

    <h1 style="text-align: center; color: skyblue; background-color: beige">{{ Auth::user()->name }}</h1>

    {{-- Button for creating new post. --}}
    <form action=" {{ route('create')}} " method="GET">
        <button type="submit" style="width: 10%; min-height: 50px; font-size: 24pt;"> New Post </button>
    </form>

    @if (session('message'))
        <p style="background-color: chartreuse"> {{ session('message') }} </p>
    @endif

    <ul>
        @foreach($posts as $post)

        <div>
            <a href=" {{ route('show', ['id' => $post->id]) }}" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; text-decoration: none;">
                
                <div style="background-color:lightblue; width:50%; margin: auto; padding: 1em; border-radius: 20px;" >
                    <h4 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{$users[$post->user_id-1]->name}} @ {{$users[$post->user_id-1]->email}}</h2>
        
                    @if($post->image != NULL)
                        <div style="text-align: center;">
                            <img src=" {{ asset('storage/images/'. $post->image) }} " alt="Image posted by {{$users[$post->user_id-1]->name}}" width="500" height="500">
                        </div>
                    @endif
                    <h3>{{$post->caption}}</h3>
                    
                    @inject('time', 'App\Http\Controllers\TimeElapsed')
                    <p style="text-align: right; font-size: 1.5em; padding-right: 5%;">
                        {{ $time::time_elapsed_string($post->created_at) }}
                    </p>
                    </div>
                <div style="height: 1cm;">
                </div>

            </a>
        </div>
        

        @endforeach
    </ul>

@endsection