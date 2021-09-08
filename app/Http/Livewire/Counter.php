<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Comment;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nette\Schema\ValidationException;

use Intervention\Image\ImageManagerStatic;

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

    private  function storeImage(){

        $img =  ImageManagerStatic::make($this->image)->resize(500)->encode('png');

        $name = Str::random(15).'.jpg';

//        $this->image->storeAs('public/images',$name);
//        \Storage::disk('public/images')->put($name,$img); error
        \Storage::disk('public')->put('images/'.$name,$img);

        return $name;
    }

    public  function addComment(){
//        $commnet = new Comment();
//        $commnet->user_id= Auth::user()->id;
//        $commnet->save();
        $this->validate();

        $imageFileName = null;
        if($this->image){
        $imageFileName = $this->storeImage() ;
        }


        Comment::create(
            [
                'user_id'=>auth()->user()->id,
                'content'=> $this->newComment,
                'image' => $imageFileName,
            ]
        );
        $this->newComment ='';
        $this->image = '';

        session()->flash("message", "Comment is Added Successfully");
    }

    public $newComment;
    public  $image;

    use WithPagination;
    use WithFileUploads; // NOTE 파일 업로드 필수

    protected $rules = [
        'image' => 'nullable|image|max:10240',
    ];
    protected $listeners = ["delete"=>'remove'];

    public  function  remove($commnetId){
            $commnet = Comment::find($commnetId);
            \Storage::disk('public')->delete('images/'.$commnet->image);
            $commnet->delete();

            session()->flash("message", "Comment is deleted Successfully");
    }

    public function updated($propertyName){
            $this->validateOnly($propertyName,[
                'image'=>'image'
            ]);


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
