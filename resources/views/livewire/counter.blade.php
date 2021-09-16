{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1> Hello livewire</h1>
            <div>
                @if(session()->has('message'))
                    <p>{{session('message')}}</p>
                @endif
            </div>
            <div>
                <button wire:click="increment" >+</button>
                <h1>{{$count}}</h1>
                <button wire:click="decrement" >-</button>
            </div>
            <div>
                <input type="text" wire:model.debounce.500ms="name" > <br/>
                <input type="text" wire:model.lazy="name" > <br/>
                <span>{{$name}}</span>
            </div>

            <section>
{{--                NOTE wire loading 사용법 . target은 evnet 또는 model 에서 사용가능--}}
                <div wire:loading wire:target="image">
                    loading...
                </div>
                @if($image)
                    <img src={{$image->temporaryUrl()}}  width="200px" height="200px" >
                @endif
                <input type="file" wire:model="image"  wire:loading.attr="disabled" id="image" >
                @error('image')
                    <div>
                        <span>{{$message}}</span>
                    </div>
                @enderror
            </section>

            <form class="flex my-4" wire:submit.prevent="addComment">

                <label for="new comment"></label>
                <input wire:model="newComment"  type="text" name="" id="new comment" placeholder="new comment here..." >
                {{$newComment}}
                @error($newComment)
                <div>
                    <span>{{$message}}</span>
                </div>
                @enderror
                <button type="submit" >Add</button>
            </form>

            @foreach($comments as $comment)
            <div class="card bordered">
                <figure>
                    @if($comment->image)
{{--                        storage/public/ image Name --}}
                    <img  class="max-w-6xl" src="{{$comment->image_path}}">
                    @endif
                </figure>
                <div wire:click="$emit('deleteClicked',{{$comment->id}})" >Delete</div>
                <div wire:click="$emit('deleteClicked',{{$comment->id}})" >edit</div>
                <button wire:click="$emit('openModal', 'edit-comment',{{ json_encode(["comment" => $comment->id]) }})">Edit User</button>
                <div class="card-body">
                    <h2 class="card-title">Top image
                        <div class="badge mx-2 badge-secondary">NEW</div>
                    </h2>
                    <h3>{{ $comment->writer->name }}</h3>
                    <h3>{{ $comment->created_at->diffForHumans() }}</h3>
                    <p>{{$comment->content}}</p>
                    <div class="justify-end card-actions">
                        <button class="btn btn-secondary">More info</button>
                    </div>
                </div>
            </div>
            @endforeach
            {{$comments->links()}}
        </div>

    </div>

    <script>
        window.livewire.on('deleteClicked',(id)=>{
            if(confirm(`Are you sure to delete? ${id}`)){
                window.livewire.emit('delete',id);
            }
        })
        window.livewire.on('EditClicked',(id)=>{
            if(confirm(`Are you sure to Edit? ${id}`)){
                window.livewire.emit('edit',id);
            }
        })
    </script>
{{--</x-app-layout>--}}



