<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sponsorID' => '0',
            'activationCode' => '0000000000',
            'firstName' => 'admin',
            'middleName' => 'admin',
            'lastName' => 'admin',
            'date_of_birth' => '07-07-1997',
            'contactInfo' => '09978366415',
            'email' => 'admin@stellar.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
