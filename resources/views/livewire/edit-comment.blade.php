<div class="py-12  flex flex-col justify-center items-center ">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form  wire:submit.prevent="updateComment" >
        <input type="text"  wire:model.lazy="content"  >
        {{$comment->id}}
        <button type="submit">제출</button>
    </form>
</div>
