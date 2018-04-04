<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use Blog\Post;

class PostsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 20; $i++) {
            $jsonMeta = [
                'title'         => $faker->sentence,
                'description'   => $faker->text(46),
                'author'        => $faker->name,
            ];

            Post::create([
                'slug'              => $faker->word,
                'user_id'           => 1,
                'meta'              => $jsonMeta,
                'content'           => $faker->paragraph(64),
                'published_at_date' => Carbon::now()
            ]);
        }
    }


}
