<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
// use Unsplash\Photo;
// use Unsplash\Search\PhotoSearch;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Blog::class;

    public function definition(): array
    {
        $paragraphs = $this->faker->paragraphs(3, true); // Generate 3 paragraphs of text
        // $photoSearch = new PhotoSearch();
        // $photos = $photoSearch->getRandomPhotos(['query' => 'nature', 'count' => 1]);
        // $imageUrl = $photos[0]->getUrls()->getRegular();

        return [
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'post' => '<p>' . $paragraphs . '</p>',
            'slug' => $this->faker->slug,
            'featuredImage' => $this->faker->imageUrl(600, 300, 'nature'),
            'metaDescription' => $this->faker->sentence,
            'post_excerpt' => $this->faker->paragraph,
        ];
    }
}
