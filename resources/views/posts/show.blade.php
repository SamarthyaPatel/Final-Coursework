@extends('layouts.basic')

@section('title', $user->name)

@section('content')

    <div style="background-color:lightblue; width:50%; margin: auto; padding: 1em; border-radius: 20px;">

        <a href=" {{route('index')}} " style="font-size: 4em; padding-left: 0.5em; text-decoration: none; font-family:'Courier New', Courier, monospace; color: white;">🠔</a>

        <p style="font-weight: bold; font-size: 3em; "> {{$post->caption}} </p>
        
        @inject('time', 'App\Http\Controllers\TimeElapsed')
        <p style="text-align: right; font-size: 1.5em; padding-right: 5%;">
            {{ $time::time_elapsed_string($post_time) }}
        </p>
    </div>

    @if ($post->user_id == Auth::user()->id)
        <form action="{{ route('destroy', ['id' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endif

@endsection