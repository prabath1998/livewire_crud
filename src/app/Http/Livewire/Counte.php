<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counte extends Component
{
    public function render()
    {
        return view('livewire.counte');
    }

    public $count = 3;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
