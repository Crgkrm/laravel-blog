<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
     use HasFactory;
     protected $fillable=['title',
     'slug',
     'body',
     'thumbnails',
     'active',
     'published_at',
     'user_id',
     'meta_title',
     'meta_description'
];
//The $casts property on your model provides a convenient method of converting attributes to common data types. The $casts property should be an array where the key is the name of the attribute being cast and the value is the type you wish to cast the column to.//

protected $casts=['published_at' => 'datetime'
];

public function user(){
    //belongto inverse of one to many//
    //many post belong to single user//
    return $this->belongsTo(User::class);
}

 public function categories(){
    //hasMany is used in a One To Many relationship while belongsToMany refers to a Many To Many relationship.
    return $this->belongsToMany(Category::class);
  
    
}
 public function shortBody(){
    return Str::words(strip_tags($this->body),30);
}

 public function getFormateddate(){
  return $this->published_at->format('F jS Y');
}

public function getThumbnails(){
    if(str_starts_with($this->thumbnails,'http')){
        return $this->thumbnails;
    }
    return '/storage/'.$this->thumbnails;
}

}
//Filament is a content management framework for rapidly building a beautiful administration interface designed for humans
