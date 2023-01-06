<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\TimeElapsed;

class ListController extends Controller
{
    public function list()
    {
        $comments = Comment::get();
        $comments = $comments->reverse();
        
        foreach($comments as $comment) {
            
            ?>
            <div class="first-input">
                <h1><?php echo $comment->comment;?></h1>
                <p><?php echo TimeElapsed::time_elapsed_string($comment->created_at) ?></p>
            </div>

            <?php

        }
    }
}
?>