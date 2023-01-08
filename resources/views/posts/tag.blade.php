@extends('layouts.basic')

<?php

use App\Models\Tag;
use App\Models\Post;

$post = new Post();

$tag = Tag::find($id);

$posts = $tag->posts;

?>

@section('content')

    <div class="container mt-5">
        <div class="card shadow p-1 mb-3 bg-white rounded" style="width: 50%; margin:auto;">

            <div class="mt-4 px-3 w-100" style="text-align: center;">
                <h5>{{$tag->name}} tag</h5>
            </div>

            <div class="card-deck m-4 justify-content-center">
                    
                @foreach ($posts as $post)
                    
                    <div class="card mt-3 ms-3 mb-2">
                        @if($post->image)
                            <img class="card-img-top" src="{{ asset('storage/images/'. $post->image) }}">
                        @endif
                        <div class="card-body">
                            <p class="card-text">
                                {{$post->caption}}
                            </p>
                        </div>
                        <div class="card-footer">
                            @inject('time', 'App\Http\Controllers\TimeElapsed')
                            <small class="text-muted"> {{ $time::time_elapsed_string($post->created_at) }} </small>
                        </div>
                        <a href=" {{ route('show', ['id' => $post->id]) }}" ><span class="stretched-link"></span></a>
                    </div>

                @endforeach

            </div>

        </div>
    </div>

@endsection