@extends('layouts.basic')

@section('title', 'New Post')

@section('content')

    <form method="POST" action="{{ route('store') }}">
        @csrf
        <!-- <p>Image: <input type="image" src="" alt=""></p>  -->
        <p>Caption: <input type="text" name="caption"></p>

        <input type="submit" value="Submit">
    </form>

    <form action="{{ route('index') }}" method="GET">
        <button type="submit"> Cancel </button>
    </form>

@endsection