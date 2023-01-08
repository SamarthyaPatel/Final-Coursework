<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;

class Comments extends Component
{

    public $online_user;

    public $online_user_name;

    public $post;

    public $commentList;

    public $newComment;

    public function mount($post_id, $online_user) {

        $this->online_user_name = User::findOrFail($online_user)->name;

        $this->post = $post_id;

        $this->commentList = Comment::latest()->get()->where('post_id', $this->post);
    }

    public function addComment()
    {
        $this->commentList = Comment::latest()->get()->where('post_id', $this->post);

        $this->newComment = "";
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $post = $comment->post_id;
        $comment->delete();

        $this->commentList = Comment::latest()->get()->where('post_id', $this->post);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
