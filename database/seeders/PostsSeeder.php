<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('posts')->insert([
        //     'title' => Str::random(20),
        //     'content' => Str::random(100),
        //     'published_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        Post::factory()->count(10)->create();
    }
}
