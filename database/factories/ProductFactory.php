<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = rand(1,1000);
        $discount = rand(1,90);
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'short_description' => $this->faker->sentences(3, true),
            'description' => $this->faker->sentences(3, true),
            'cat_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'brand_id'=>$this->faker->randomElement(Brand::pluck('id')->toArray()),
            'child_cat_id'=>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'vendor_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
            'price' => $price,
            'discount' => $discount,
            'sale_price' => ($price-(($price*$discount)/100)),
            'quantity' => rand(1, 5),
            'code' => Str::random(4),
            'size'=>$this->faker->randomElement(['', 'S', 'M', 'L', 'XL']),
            'conditions'=>$this->faker->randomElement(['', 'new', 'popular', 'winter']),
            'status'=>$this->faker->randomElement(['show', 'hide']),
            'image_url1' => rand(1,30).'.jpg',
            'image_url2' => rand(1,30).'.jpg',
            'image_url3' => rand(1,30).'.jpg',
            'image_url4' => rand(1,30).'.jpg',
        ];
    }
}
