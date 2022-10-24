<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{

    public $newComment;

    public $comments;

    public function render()
    {
        return view('livewire.comments');
    }

    public function addComment()
    {
        if ($this->newComment == '') {
            return;
        }
        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 1]);
        $this->comments->prepend($createdComment);
        $this->newComment = '';
    }

    public function mount()
    {
        $initialComments = Comment::latest()->get();
        $this->comments = $initialComments;
    }
}
