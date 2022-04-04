<?php

namespace Database\Factories;

use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeaturedProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeaturedProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pro_id'=>$this->faker->randomElement(Product::pluck('id')->toArray()),
            'status'=>'active',
        ];
    }
}
