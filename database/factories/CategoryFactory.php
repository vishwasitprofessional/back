<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentences(3, true),
            'is_parent' => $this->faker->randomElement([true,false]),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'parent_id'=>$this->faker->randomElement(Category::pluck('id')->toArray()),
            'image_url1' => rand(0, 30).'.jpg',
            'image_url2' => rand(0, 30).'.jpg',
            'image_url3' => rand(0, 30).'.jpg',
            'image_url4' => rand(0, 30).'.jpg',
        ];
    }
}
