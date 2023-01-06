<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        $posts = $posts->reverse();
        $users = User::get();
        return view('posts.index', ['posts' => $posts, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption'=>'required',
        ]); 
        // Getting values from the blade template form
        $post = new Post;
        $post->caption = $request->input('caption');
        $post->user_id = Auth::user()->id;
        $post->save();

        session()->flash('message', 'New Post Uploaded.');

        return redirect('/platform');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        $post_time = $post->created_at;
        $comments = Comment::get();
        $comments = $comments->reverse();
        return view('posts.show', ['post' => $post, 'user' => $user, 'post_time' => $post_time, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $current_user = Auth::user()->id;
        $post_user = $post->user_id;

        if($post_user == $current_user) {
            $post->delete();
        } else {
            return redirect()->route('index')->with('message', 'You can not delete ' . User::findOrFail($post_user)->name . '\'s post. ');
        }

        return redirect()->route('index')->with('message', 'Post was deleted successfully.');
    }

}
