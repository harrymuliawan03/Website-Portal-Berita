<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostDetail>
 */
class PostDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => mt_rand(9, 15),
            'user_id'       => mt_rand(1, 10),
            'category_id'   => mt_rand(1, 8),
            'category_detail_id' => mt_rand(1, 22)
        ];
    }
}