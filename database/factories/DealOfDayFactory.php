<?php

namespace Database\Factories;

use App\Models\DealOfDay;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealOfDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DealOfDay::class;

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
