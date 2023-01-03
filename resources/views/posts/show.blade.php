@extends('layouts.basic')

@section('title', $post -> id)

@section('content')

    <ul>
        <li> Posted: {{$post->created_at}} </li>
        <li> Caption: {{$post->caption}} </li>
    </ul>

    @if ($post->user_id == Auth::user()->id)
        <form action="{{ route('destroy', ['id' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endif

    <a href=" {{route('index')}} ">Back</a>

@endsection