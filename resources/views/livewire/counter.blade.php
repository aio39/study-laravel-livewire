<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
            <h1> Hello livewire</h1>
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
            <p>{{$comments}}</p>
            @foreach($comments as $comment)
            <div class="card bordered">
                <figure>
                    @if($comment->image)
                    <img src="{{$comment->image}}">
                    @endif
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Top image
                        <div class="badge mx-2 badge-secondary">NEW</div>
                    </h2>
                    <p>{{$comment->content}}</p>
                    <div class="justify-end card-actions">
                        <button class="btn btn-secondary">More info</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>


