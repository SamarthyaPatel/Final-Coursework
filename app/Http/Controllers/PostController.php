<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(2);
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
            'caption'=>'required|max:200',
        ]); 

        $post = new Post;

        //If there is an image, store image, else go ahead.
        if($request->file('image') != NULL) {
            $image = $request->file('image')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('image'), $image);
            $post->image = $image;
            $post->size = $size;
        }

        $caption = $request->input('caption');
        $post->caption = $caption;
        $post->user_id = Auth::user()->id;
        $post->save();

        //If tags are added, then link them with the post, else go ahead.
        if($request->input('tag') != NULL) {
            $tags = $request->input('tag');
            
            //For each tag, check whether they exist, if yes then link, else make new tag and then link.
            foreach($tags as $tag) {
                if($tag != NULL) {
                    if(Tag::where('name', $tag)->first()) {
                        $tag_id = Tag::where('name', $tag)->get();
                        $post->tags()->attach($tag_id);
                    } else {
                        $item = new Tag;
                        $item->name = $tag;
                        $item->save();
                        $post->tags()->attach($item);
                    }
                } 
            }
        }

        session()->flash('message', 'New Post Uploaded.');

        return redirect('/posts');
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
        return view('posts.show', ['post' => $post, 'user' => $user, 'post_time' => $post_time]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', ['id' => $id]);
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
        $post = Post::findOrFail($id);

        //Check whether new image is uploaded, if yes, save, else go ahead. 
        if($request->file('image') != NULL) {
            $image = $request->file('image')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('image'), $image);
            $post->image = $image;
            $post->size = $size;
        }

        $request->validate([
            'caption'=>'required|max:200',
        ]);

        $caption = $request->input('caption');
        $post->caption = $caption;
        $post->user_id = Auth::user()->id;
        $post->save();

        //If tags are added, then link them with the post, else go ahead.
        if($request->input('tag') != NULL) {
            $tags = $request->input('tag');
            
            //For each tag, check whether they exist, if yes then link, else make new tag and then link.
            foreach($tags as $tag) {
                if($tag != NULL) {
                    if(Tag::where('name', $tag)->first()) {
                        $tag_id = Tag::where('name', $tag)->get();
                        $post->tags()->attach($tag_id);
                    } else {
                        $item = new Tag;
                        $item->name = $tag;
                        $item->save();
                        $post->tags()->attach($item);
                    }
                } 
            }
        }

        session()->flash('message', 'Your post is updated.');

        return redirect('/posts');
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
        $post->delete();

        return redirect()->route('index')->with('message', 'Post was deleted successfully.');
    }

    /**
     * Displays the tags board.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBoard(){
        return view('posts.board');
    }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTag($id) {

        return view('posts.tag', ['id' => $id]);
    }

}
