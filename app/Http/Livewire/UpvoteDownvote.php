<?php
namespace App\Http\Livewire;
use App\Models\Post;
use Livewire\Component;

class UpvoteDownvote extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        
        $upvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', true)
            ->count();

        $downvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', false)
            ->count();

        // The status whether current user has upvoted the post or not.
        // This will be null, true, or false
        // null means user has not done upvote or downvote
           $hasUpvote=NULL;
        /** @var \App\Models\User $user */
        $user = request()->user();
        if ($user) {
            $model = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();
            if ($model) {
                // !! converting the result to actual boolean value//
                $hasUpvote = !!$model->is_upvote;
            }
        }

        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes','hasUpvote'));
    }

    public function upvoteDownvote($upvote = true)
    {
        /** @var \App\Models\User $user */
        $user = request()->user();
        if (!$user) {
            return $this->redirect('login');
        }
        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }
       //create upvote on that post//
        $model = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

        if (!$model) {
            \App\Models\UpvoteDownvote::create([
                'is_upvote' => $upvote,
                'post_id' => $this->post->id,
                'user_id' => $user->id
            ]);

            return;
        }
        //check if post is upvote or downvote//
        if ($upvote && $model->is_upvote || !$upvote && !$model->is_upvote){
            //if the post is upvote then delete it//
            $model->delete();
        } else {
            //if the post is downvote the save it//
            $model->is_upvote = $upvote;
            $model->save();
        }
    }

    }


