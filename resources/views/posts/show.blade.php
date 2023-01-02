@extends('layouts.basic')

@section('title', $post -> id)

@section('content')

    <ul>
        <li> Posted: {{$post->created_at}} </li>
        <li> Caption: {{$post->caption}} </li>
    </ul>

    <form action="{{ route('index') }}" method="GET">
        <button type="submit"> Delete </button>
    </form>

@endsection