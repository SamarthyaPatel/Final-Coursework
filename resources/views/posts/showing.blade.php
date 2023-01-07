<?php
use App\Models\Comment;
use App\Models\User;
use App\Http\Controllers\TimeElapsed;
use App\Http\Controllers\CommentController;



$comments = Comment::get()->where('post_id', $post->id);
$comments = $comments->reverse();
$online_user = Auth::user()->id;
?>

@extends('posts.duplicate')

@section('listme')

    @foreach ($comments as $comment)

    <div style="background-color: skyblue; border-radius: 10px; padding: 5px;">
        @php
            $user = User::findOrFail($comment->user_id);
        @endphp
        @if ($online_user == $user->id)
        <form action=" {{route('comment-delete', ['id' => $comment->id])}} " method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endif

        <h3 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: white;">  {{$user->name }} </h3>
        <h3 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; "> {{$comment->comment}} </h3>
        <p style="text-align: right; font-size: 1em; padding-right: 5%;"> {{TimeElapsed::time_elapsed_string($comment->created_at)}} </p>
    </div>
    <div>&nbsp;</div>
        
    @endforeach
@endsection

