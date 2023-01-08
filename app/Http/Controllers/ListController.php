<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Http\Controllers\TimeElapsed;
use App\Http\Controllers\CommentController;

class ListController extends Controller
{
    public function list($id)
    {
        $comments = Comment::get()->where('post_id', $id);
        $comments = $comments->reverse();
        
        foreach($comments as $comment) {
            $user = User::findOrFail($comment->user_id);
            
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{new CommentController::destroy(68)}}"><input type="button" value="delete"></form>
                    <div class="card-title" style="font-weight: bold;"><?php echo $user->name;?></div>
                    <p class="card-text"><?php echo $comment->comment;?></p>
                    <p class="card-text" style="text-align: right;"><small><?php echo TimeElapsed::time_elapsed_string($comment->created_at) ?></small></p>
                </div>
            </div>
            <?php

        }
    }

}
?>
