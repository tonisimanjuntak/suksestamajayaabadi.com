<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'namasupplier' => $this->faker->company,
            'alamatsupplier' => $this->faker->address,
            'notelpsupplier' => $this->faker->phoneNumber,
            'emailsupplier' => $this->faker->unique()->companyEmail,
        ];
    }
}
