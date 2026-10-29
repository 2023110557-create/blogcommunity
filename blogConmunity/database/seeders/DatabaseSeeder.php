<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Country;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Países
        $countries = Country::factory(5)->create();

        // 2. Usuarios repartidos entre países, cada uno con su perfil
        $users = User::factory(20)
            ->recycle($countries)
            ->create()
            ->each(fn ($user) => Profile::factory()->create(['user_id' => $user->id]));

        // 3. Tags
        $tags = Tag::factory(15)->create();

        // 4. Posts + tags + comentarios
        Post::factory(50)
            ->recycle($users)
            ->create()
            ->each(function (Post $post) use ($tags, $users) {
                $post->tags()->attach($tags->random(rand(1, 4))->pluck('id'));
                Comment::factory(rand(0, 5))
                    ->recycle($users)
                    ->create([
                        'commentable_id' => $post->id,
                        'commentable_type' => Post::class,
                    ]);
            });

        // 5. Videos + tags + comentarios
        Video::factory(15)
            ->recycle($users)
            ->create()
            ->each(function (Video $video) use ($tags, $users) {
                $video->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
                Comment::factory(rand(0, 3))
                    ->recycle($users)
                    ->create([
                        'commentable_id' => $video->id,
                        'commentable_type' => Video::class,
                    ]);
            });

        // 6. Likes sin duplicados
        $posts = Post::all();
        foreach ($users as $user) {
            foreach ($posts->random(rand(0, 10)) as $post) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}