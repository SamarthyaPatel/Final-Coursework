<?php
use App\Models\User;
use App\Models\Post;

$user = User::findOrFail(Post::findOrfail($id)->user_id);
?>

@extends('layouts.basic')

@section('content')
    
    <div class="container" style="background: pink;">
        <div class="card shadow p-1 my-3 bg-white rounded" style="width: 70%; margin:auto;">
            
            <h1>{{$user->name}}</h1>

        </div>
        
    </div>

@endsection