<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Project;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'user_id' =>function(){
            if(User::count()){
                return User::all()->random()->id;
            }else{
                return factory(User::class)->create()->id;
            }


        },

        'name' => $faker->name($gender = null),
        'city' => $faker->city,
    ];
});