<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $fillable=['title' , 'slug'];


 public function posts(){
    
       //hasMany is used in a One To Many relationship while belongsToMany refers to a Many To Many relationship.
        return $this->belongsToMany(Post::class);
      
    }

}
