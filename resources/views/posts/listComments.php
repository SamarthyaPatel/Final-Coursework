<?php

    // $comments = Comment::get();
    
    foreach($comments as $comment) {
        ?>
            <h1> <?php echo $comment->comment;?> </h1>

            <!-- @inject('time', 'App\Http\Controllers\TimeElapsed')
            <p style="text-align: right; font-size: 1.5em; padding-right: 5%;">
                {{ $time::time_elapsed_string($comment->created_at) }}
            </p> -->

            <div style="height: 1cm;"></div>
        <?php
    }
    
?>