<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
 
class NotificationController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {   
        $comment = $request->input('comment');
        $post = Post::findOrFail($id);
        $to_email = User::findOrFail($post->user_id);
        Mail::to($to_email)->send(new Notification($post, $comment));
    }
}