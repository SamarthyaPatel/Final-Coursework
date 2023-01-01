@extends('layouts.basic')

@section('title', 'Post Index')

@section('content')
    <P>The posts on the social platform</P>
    <ul>
        @foreach($posts as $post)
            <li>{{ $post->caption }}</li>
        @endforeach
    </ul>

@endsection