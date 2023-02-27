<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Penelitian;
use Faker\Generator as Faker;

$factory->define(Penelitian::class, function (Faker $faker) {
    return [
        'title' => $this->faker->words(3, true),
        'abstract' => $this->faker->words(3, true),
        'description' => $this->faker->words(3, true),
        'keyword' => $this->faker->words(3, true),
        'author' => $this->faker->words(3, true),
        'institution' => $this->faker->words(3, true),
        'status' => "draft",
        'file_name_full_article' => $this->faker->words(3, true),
        'loc_file_name_full_article' => $this->faker->words(3, true),
        'upload_by' => $this->faker->randomNumber(1),
        'publish_by' => $this->faker->randomNumber(1)
    ];
});
