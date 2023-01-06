<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Auth;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Platform - {{$user->name}} </title>
</head>
<body>
    <h1>Social Platform - {{$user->name}} </h1>

    <div style="background-color:lightblue; width:50%; margin: auto; padding: 1em; border-radius: 20px;">
        <div>
            <a href=" {{route('index')}} " style="font-size: 4em; padding-left: 0.5em; text-decoration: none; font-family:'Courier New', Courier, monospace; color: white;">🠔</a>
            @if ($user->id == Auth::user()->id)
                <form action="{{ route('destroy', ['id' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: transparent; border: 0; padding-left: 90%;">
                        <svg height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg" style="color: white;"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                    </button>
                </form>
            @endif
            
            <p style="font-weight: bold; font-size: 3em; "> {{$post->caption}} </p>
            
            @inject('time', 'App\Http\Controllers\TimeElapsed')
            <p style="text-align: right; font-size: 1.5em; padding-right: 5%;">
                {{ $time::time_elapsed_string($post_time) }}
            </p>
        </div>

        <div class="container">
            <h1>Comments</h1>

            <div class="col-md-5">
                <input type="text" class="comment form-control" placeholder="Comment" style="min-width: 70%; font-size: 1.2em;">

                <a href="javascript:void(0)" class="btn btn-primary submit" style="font-size: 2.5em; text-decoration: none; color: white; font-weight: bolder; text-align: right;"> <br> + </a>
            </div>
            <br>
            <br><br>
            <div class="listComments"></div>

        </div>
    </div>

</body>
</html>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function listComment(){
        $.ajax({
                url:'{{route("list", ["id" => Auth::user()->id])}}',
                success:function(res){
                    $('.listComments').html(res);
                }
            });
    }
    listComment();

    $(function(){
        setInterval(() => {
            listComment();            
        }, 1000);
    });

    $(".submit").click(function (e) {

        e.preventDefault();
        var comment = $(".comment").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('comment', ['id' => Auth::user()->id]) }}",
            data: {
                comment: comment
            },
            success: function (data) {
                listComment();
                $.ajax({
                    type: 'get',
                    url: "{{ route('send-notification', ['id' => $post->id]) }}",
                    data: {
                        comment: comment
                    },
                    success:function(){

                    }
                })
            }
        });
    });

</script>