@extends('layouts.basic')

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;

$user = User::findOrFail($id);
$profile = Profile::where('user_id', $user->id)->first();
$posts = Post::where('user_id', $user->id)->get()->reverse();
?>

@section('content')
    
    <div class="container">
        <div class="shadow p-1 my-5 bg-white rounded" style="width: 70%; margin:auto;">

            <nav class="navbar mt-4">
                <a href=" {{route('index')}} " class="nav-link ps-3" style="font-size: 2em;"> 🠔 </a>
            </nav>

            <div class="mt-4 px-3 w-100" style="text-align: center;">
                <img src="{{ asset('storage/images/'. $profile->avatar) }}" alt="" class="avatar">
                <h1 class="mt-3">{{$user->name}}</h1>
                <h1> @ {{$profile->username}}</h1>
            </div>

            <div class="card-columns m-4" style="background-color: lightyellow; ">
                    
                @foreach ($posts as $post)
                    
                    <div class="card mt-3 ms-3 mb-2" style="width: 250px;">
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

    <style>
        .card {
            display: inline-block;
        }

        .avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
    </style>

@endsection