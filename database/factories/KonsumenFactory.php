<?php

namespace Database\Factories;

use App\Models\Konsumen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Konsumen>
 */
class KonsumenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Konsumen::class;

    public function definition(): array
    {
        // return [
        //     'name' => $this->faker->name,
        //     'email' => $this->faker->unique()->safeEmail,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'), 
        //     'remember_token' => \Illuminate\Support\Str::random(10),
        //     'address' => $this->faker->address,
        //     'city' => $this->faker->city,
        //     'state' => $this->faker->state,
        //     'postcode' => $this->faker->postcode,
        //     'country' => $this->faker->country,
        //     'phone' => $this->faker->phoneNumber,
        //     'dob' => $this->faker->date,
        //     'company' => $this->faker->company,
        //     'job_title' => $this->faker->jobTitle,
        //     'text' => $this->faker->text,
        //     'number' => $this->faker->randomNumber,
        //     'boolean' => $this->faker->boolean,
        //     'date' => $this->faker->date,
        //     'time' => $this->faker->time,
        //     'datetime' => $this->faker->dateTime,
        //     'url' => $this->faker->url,
        //     'ipv4' => $this->faker->ipv4,
        //     'ipv6' => $this->faker->ipv6,
        //     'macAddress' => $this->faker->macAddress,
        // ];

        return [
            'namakonsumen' => $this->faker->name,
            'alamatkonsumen' => $this->faker->address,
            'notelpkonsumen' => $this->faker->phoneNumber,
            'emailkonsumen' => $this->faker->unique()->safeEmail,
        ];
    }
}
