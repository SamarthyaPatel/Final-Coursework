<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment'=>'required',
        ]);
        
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->post_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        session()->flash('message', 'New Comment Uploaded.');

    }

    /**
     * Update the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->input('comment');
        $comment->save();

        session()->flash('message', 'Comment updated.');
    }

}
?>