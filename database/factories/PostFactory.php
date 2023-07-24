<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
       $title=fake()->realText(50);
        return [
             'title'=>$title,
             'slug'=>Str::slug($title),
             'thumbnails'=>fake()->imageURL,
             'body'=>fake()->realText(500),
             'active'=>fake()->boolean,
             'published_at'=>fake()->dateTime,
             'user_id'=>4
        ];
    }
}
