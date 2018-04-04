<?php


use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Blog\Post::class, function (Faker $faker) {
    return [
        'slug'              => 'test-post',
        'user_id'           => 1,
        'meta'              => [
            'title'         => 'Test Post',
            'author'        => 'Test Author',
            'description'   => 'This is a test post.'
        ],
        'content'           => 'Test content.',
        'published_at_date' => Carbon::now(),
    ];
});

$factory->state(Blog\Post::class, 'unpublished', function (Faker $faker) {
    return [
        'published_at_date' => null
    ];
});