<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use App\Post;

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
                'title'         => $faker->word,
                'description'   => $faker->text(16),
                'author'        => $faker->name,
            ];

            $meta = json_encode($jsonMeta);

            Post::create([
                'slug'              => $faker->word,
                'meta'              => $meta,
                'content'           => $faker->paragraph,
                'published_at_date' => Carbon::now()
            ]);
        }
    }


}
