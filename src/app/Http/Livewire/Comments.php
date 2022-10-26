<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;

class Comments extends Component
{

    use WithPagination;

    public $newComment;
    public $image;
    public $ticketId = 1;

    protected $listeners = [
        'fileUpload' => 'handleFilepUpload',
        'ticketSelected',
    ];

    public function handleFilepUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id',$this->ticketId)->latest()->paginate(2)
        ]);
    }

    public function addComment()
    {

        $this->validate(['newComment' => 'required|max:255']);
        $image = $this->storeImage();

        $createdComment = Comment::create(
            [
                'body' => $this->newComment,
                'user_id' => 1,
                'image' => $image,
                'support_ticket_id' => $this->ticketId,
            ]
        );
        $this->newComment = '';
        $this->image = '';
        session()->flash('message', 'Comment added successfully..! 🤪');
    }

    //update comment
    public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully..! 🤩');
    }

    public function storeImage()
    {
        if (!$this->image) {
            return null;
        }

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        Storage::put('image.jpg', $this->image);
    }


    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }
}
