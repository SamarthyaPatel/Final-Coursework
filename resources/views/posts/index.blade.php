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

        <div style="background-color:lightblue; width:50%; margin: auto; padding: 1em; border-radius: 20px;">
            <h4 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{$users[$post->user_id-1]->name}} @ {{$users[$post->user_id-1]->email}}</h2>
            <h3><a href=" {{ route('show', ['id' => $post->id]) }}" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; text-decoration: none;">{{$post->caption}}</a></h4>
        </div>
        <div style="height: 1cm;">
        </div>

        @endforeach
    </ul>

@endsection