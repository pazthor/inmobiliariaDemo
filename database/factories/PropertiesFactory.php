<?php

use Faker\Generator as Faker;
use App\Models\Project;

$factory->define(App\Models\Property::class, function (Faker $faker) {
    return [
        //
        'project_id' => function () {
            if (Project::count()) {
                return Project::all()->random()->id;
            } else {
                return factory(Project::class)->create()->id;
            }
        },
        'sku' => $faker->swiftBicNumber,
        'price' => $faker->randomNumber(6),
        'status' => $faker->randomElement($array = array ('Sold','Available','Separated')),
        'type' => $faker->randomElement($array = array ('Department','House','House')),
        'description'=> $faker->text(200)
    ];
});