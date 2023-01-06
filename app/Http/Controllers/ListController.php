<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Http\Controllers\TimeElapsed;

class ListController extends Controller
{
    public function list()
    {
        $comments = Comment::get();
        $comments = $comments->reverse();
        
        foreach($comments as $comment) {
            $user = User::findOrFail($comment->user_id);
            ?>
            <div style="background-color: skyblue; border-radius: 10px; padding: 2px;">
                <h3 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: white;"> <?php echo $user->name;?> </h3>
                <h3 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; "> <?php echo $comment->comment;?> </h3>
                <p style="text-align: right; font-size: 1em; padding-right: 5%;"><?php echo TimeElapsed::time_elapsed_string($comment->created_at) ?></p>
            </div>
            <div>&nbsp;</div>
            <?php

        }
    }
}
?>