<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CommentCreate extends Component
{
    public string $comment="";
    public Post $post;
    public ?Comment $commentModel=null;
    public function mount(Post $post,$commentModel=null)
    {
        $this->post = $post;
        //commentModel equal to reacived commentmodel//
        $this->commentModel=$commentModel;
        //check if the comment which we going to display already exits in  commentModel//
        $this->comment=$commentModel ? $commentModel->comment :'';
    }
    public function render()
    {
        return view('livewire.comment-create');
    }

    public function createComment(){
        //only logged in user can comment//
        $user=auth()->user();
        if(!$user){ 
        return $this->redirect('/login');
        }
         $comment=Comment::create([
          'comment'=>$this->comment,
          'post_id'=>$this->post->id,
          'user_id'=>$user->id
        ]);
        $this->emitUp('commentCreated',$comment->id);
        $this->comment='';
    }
}
