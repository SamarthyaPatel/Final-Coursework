@extends('layouts.basic')

@section('title', $post -> id)

@section('content')

    <ul>
        <li> Posted: {{$post->created_at}} </li>
        <li> Caption: {{$post->caption}} </li>
    </ul>

@endsection