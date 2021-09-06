<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class Counter extends Component
{
    public $count = 0;
    public $name = "init";

    public function increment(){
        $this -> count++;
    }
    public function decrement(){
        $this -> count--;
    }

    public function render()
    {
        return view('livewire.counter',[
            "comments" => Comment::all()
        ]);
    }
}
