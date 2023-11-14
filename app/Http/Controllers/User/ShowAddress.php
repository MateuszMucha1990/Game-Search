<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Faker\Factory;

class ShowAddress extends Controller
{
    public function __invoke($id)
    {
        $faker = Factory::create();
        $address = [
            'postalCode'=>$faker->postcode,
            'street'=> $faker->streetAddress,
            'houseNumber'=>$faker->numberBetween(1,100),
            'flatNumber'=>$faker->numberBetween(1,100),
        ];



        return view('user.address', [
            'address' => $address
        ]);
    }
}
