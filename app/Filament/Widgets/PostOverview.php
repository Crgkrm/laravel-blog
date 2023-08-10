<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use Filament\Widgets\Widget;
use App\Models\UpvoteDownvote;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected int | string | array $columnSpan=3;
    public ?Model $record=null;

   protected function getViewData():array{
      return [
        //$this->record->method//
          'viewCount'=>PostView::where('post_id','=',$this->record->id)->count(),
          'upvotes'=>UpvoteDownvote::where('post_id','=',$this->record->id)
                   ->where('is_upvote','=',true)->count(),
          'downvotes'=>UpvoteDownvote::where('post_id','=',$this->record->id)
           ->where('is_upvote','=',false)->count(),
           
      ];
   }

    protected static string $view = 'filament.widgets.post-overview';
}