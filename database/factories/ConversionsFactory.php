<?php

namespace Database\Factories;

use App\Models\Conversions;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conversions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'coin_id' => $this->faker->word,
        'coin_conversion_id' => $this->faker->word,
        'value_conversion' => $this->faker->randomDigitNotNull,
        'price_conversion' => $this->faker->randomDigitNotNull,
        'user_id' => $this->faker->word,
        'date_conversion' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
