<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Auth;

$comments = Comment::get();
$comments = $comments->reverse();

foreach($comments as $comment)
{
    ?>

        <h1>    <?php echo $comment->comment; ?>    </h1>

    <?php
}

?>