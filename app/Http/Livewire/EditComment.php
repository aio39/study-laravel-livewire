<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
class EditComment extends ModalComponent
{

//        protected  $listeners = [
//            'update' => 'updateComment'
//        ];

    public $comment;
    public $content;

    public function mount(Comment $comment)
    {


        $this->comment = $comment;
        $this->content = $comment->content;
    }

    public  function  updateComment(){
        DB::table('comments')
            ->where('id',  $this->comment->id)
            ->update(['content' =>  $this->content]);

        return redirect()->to('/test');
    }


    public function render()
    {
        return view('livewire.edit-comment');
    }
}
