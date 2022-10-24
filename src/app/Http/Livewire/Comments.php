<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comments extends Component
{

    public $comments = [
        [
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'created_at' => '3 min ago',
            'creator' => 'prabath'
        ],
    ];

    public function render()
    {
        return view('livewire.comments');
    }
}
