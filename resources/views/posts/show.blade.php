@extends('layouts.basic')

@section('title', $user->name)

@section('content')

    <div style="background-color:lightblue; width:50%; margin: auto; padding: 1em; border-radius: 20px;">

        <a href=" {{route('index')}} " style="font-size: 4em; padding-left: 0.5em; text-decoration: none; font-family:'Courier New', Courier, monospace; color: white;">🠔</a>
        @if ($post->user_id == Auth::user()->id)
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

        <div>
            <p>Comments</p>
            <form action="javascript:void(0)">
                @csrf
                <input type="text" name="caption">
                <input type="submit" value="Submit">
            </form>

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


    <script type="text/JavaScript">

        function listComments()
            {
                $.ajax({
                    <?php
                        ?>
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
                        <?php
                    ?>,
                    success:function(res) {
                        $('.comment_list').html(res);
                    }
                })
            }
    
        $(function() {
    
            listComments();
    
            // $request->validate([
            //     'comment'=>'required',
            // ]);
            // $.ajax({
            //     $comment = new Comment;
            //     $comment->comment = $request->input('comment');
            //     $comment->user_id = Auth::user()->id;
            //     $comment->save();
            // })
            // Getting values from the blade template form
            
            session()->flash('message', 'New Comment Uploaded.');
        })
    </script>

@endsection
