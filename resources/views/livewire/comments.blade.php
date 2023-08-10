<div>
<livewire:comment-create :post="$post"/>
@foreach($comments as $comment)
<livewire:comments-item :comment="$comment" wire:key="comments--{{$comment->id}}"/>
@endforeach

</div>
