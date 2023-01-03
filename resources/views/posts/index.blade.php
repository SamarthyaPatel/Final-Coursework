@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')

    <h1 style="text-align: center; color: skyblue; background-color: beige">{{ Auth::user()->name }}</h1>

    <h1>The posts on the social platform</h1>

    @if (session('message'))
        <p style="background-color: chartreuse"> {{ session('message') }} </p>
    @endif

    <ul>
        @foreach($posts as $post)

        <h4><a href=" {{ route('show', ['id' => $post->id]) }} ">{{$post->caption}}</a></h4>

        @endforeach
    </ul>

    {{-- Button for creating new post. --}}
    <form action=" {{ route('create')}} " method="GET">
        <button type="submit"> New Post </button>
    </form>

    {{-- <a href=" {{ route('create')}} "> New Post </a> --}}

@endsection