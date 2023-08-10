<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentsItem extends Component
{  
 
    public Comment $comment;

    public bool $editing=false;

    public function mount(Comment $comment)
    {
     $this->comment=$comment;
    }
    public function render()
    {
        return view('livewire.comments-item');
    }

      public function deleteComment(){
        $id=$this->comment->id;
        $this->comment->delete();
        $this->emitUp('commentDeleted',$id);
     }
 
  public function startCommentEdit(){
    $this->editing=true;
  }
}
