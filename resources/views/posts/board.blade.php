<?php

use App\Models\Tag;

$tags = Tag::get();

?>

@extends('layouts.basic')

@section('content')
    
    <div class="container">
        <div class="card shadow p-1 mb-3 bg-white rounded" style="width: 50%; margin:auto;">

            <div class="card-body">
                <nav class="navbar">
                    <a href=" {{route('index')}} " class="nav-link ps-3" style="font-size: 2em;">🠔 Go Back</a>
                </nav>

                <div>
                    @foreach ($tags as $tag)
                        <div class="card mb-3">
                            <div class="card-body">
                                
                                <div class="card-title" style="font-weight: bold;">
                                    <a href="{{route('tag', ['id' => $tag->id])}}"> {{$tag->name}} </a>
                                </div>
                                <p class="card-text"> {{$tag->posts->count()}} </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

@endsection