<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Platform - {{$user->name}} </title>
</head>
<body>
    <h1>Social Platform - {{$user->name}} </h1>

    <div>
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
                <p>Comments</p>

                {{-- <form method="POST" action="{{ route('comment-store') }}">
                    @csrf
                    <!-- <p>Image: <input type="image" src="" alt=""></p>  -->
                    <input type="text" name="comment">
            
                    <input type="submit" value="Submit">
                </form> --}}
    
                <div class="col-md-5">
                    <input type="text" class="comment form-control" placeholder="Comment">

                    <a href="javascript:void(0)" class="submit">SUBMIT</a>
                </div>
    
                <div class="comment_listing"></div>
    
                {{-- <div class="comment_list"> 
                    <ul>
                        @foreach($comments as $comment)
                
                        <div>
                            
                            <h1> {{ $comment->comment }} </h4>
                            
                            @inject('time', 'App\Http\Controllers\TimeElapsed')
                            <p style="text-align: right; font-size: 1.5em; padding-right: 5%;">
                                {{ $time::time_elapsed_string($comment->created_at) }}
                            </p>
                            </div>
                        <div style="height: 1cm;">
                        </div>
                
                        @endforeach
                    </ul>   
                </div> --}}
                
            </div>
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

    function listComments()
    {
        $('.comment_listing').load('listComments.php');
        // $.ajax({
        //     url: "listComments.php",
        //     success:function(res){
        //         $('.comment_listing').html(res);
        //     }
        // });
    }

    listComments();

    $(".submit").click(function (e) {

        listComments();

        e.preventDefault();
        var comment = $(".comment").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('comment', ['id' => 2]) }}",
            data: {
                comment: comment
            },
            success: function (data) {
                alert("Comment added to the post.");
                listComments();
            }
        });
    });

</script>
