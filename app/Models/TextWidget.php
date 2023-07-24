<?php

namespace App\Models;

use App\Models\TextWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TextWidget extends Model
{
    use HasFactory;


    protected $fillable=[
        'key',
        'image',
        'title',
        'content',
        'active',
      ]; 
    
    public static function getTitle(string $key){
    
     $widget=TextWidget::query()
     ->where('key','=',$key)
     ->where('active','=',1)
     ->first();
     if($widget){
         return $widget->title;
     }
    return '';
    }
    public static function getContent(string $key){
    
     $widget=TextWidget::query()
     ->where('key','=',$key)
     ->where('active','=',1)
     ->first();
     if($widget){
         return $widget->content;
     }
    return '';
    
    
}
}