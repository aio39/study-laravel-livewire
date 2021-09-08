<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;

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

//    public function validate(){}

    public  function addComment(){
//        $commnet = new Comment();
//        $commnet->user_id= Auth::user()->id;
//        $commnet->save();
        $this->validate();
        Comment::create(
            [
                'user_id'=>auth()->user->id,
                'content'=> $this->newComment,
                'image' =>'',
            ]
        );
        session()->flash("message", "Comment is Added Successfully");
    }

    public $newComment;
    use WithPagination;

    protected $listeners = ["delete"=>'remove'];

    public  function  remove($commnetId){
            $commnet = Comment::find($commnetId);
            $commnet->delete();

            session()->flash("message", "Comment is deleted Successfully");
    }

    public function  mount() {
        $this->newComment="Hello World";
    }

    public function render()
    {
        return view('livewire.counter',[
            "comments" => Comment::latest()->paginate(5)
        ]);
    }
}
