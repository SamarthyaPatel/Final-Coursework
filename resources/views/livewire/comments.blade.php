<?php
use App\Http\Controllers\TimeElapsed;
use App\Http\Controllers\CommentController;
use App\Models\User;
?>

<div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <div class="mt-3 px-3">
            <h5 class="ps-1"> Comments </h5>
            <div class="row m-0">
                <div class="col p-0" style="text-align: center;">
                    <p><input type="text" id="comment" class="comment form-control" placeholder="Add comment" wire:model.lazy="newComment"></p>
                </div>
                <div class="col-1"></div>
                <div class="col-1 p-0" style="text-align: center;">
                    <button id="post-comment" wire:click="addComment" class="submit form-control"> ➤ </button>
                </div>
            </div>

            <div>
                @foreach ($commentList as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($online_user == $comment->user_id)
                                <div style="text-align:right;">
                                    <i class="fas fa-times cursor-pointer" wire:click="deleteComment({{$comment->id}})" style="position: absolute; right: 20px;"></i>
                                </div>
                            @endif
                            <div class="card-title" style="font-weight: bold;">
                                <a href="{{route('getProfile', ['id' => $comment->user_id])}}"> {{User::findOrFail($comment->user_id)->name}} </a>
                            </div>
                            <p class="card-text"> ❑ {{$comment->comment}} </p>
                            <p class="card-text" style="text-align: right;"><small> {{TimeElapsed::time_elapsed_string($comment->created_at)}} </small></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    

    <script type="text/javascript"> 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $(".submit").click(function (e) {
    
            e.preventDefault();
            var comment = $(".comment").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('comment', ['id' => $post]) }}",
                data: {
                    comment: comment
                },
                success: function (data) {
                    var getValue= document.getElementById("comment");
                    if (getValue.value !="") {
                        getValue.value = "";
                    }
                    $.ajax({
                        type: 'get',
                        url: "{{ route('send-notification', ['id' => $post]) }}",
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

    <style>

        #post-comment {
            background-color: white; color: black;
        }

        #post-comment:hover {
            background-color: green; color: white;
        }

        i:hover {
            color: red;
        }
    </style>
</div>

