<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Rizqi Hakim',
            'username' => 'rizqi',
            'email' => 'rizqihakimm@gmail.com',
            'password' => bcrypt('123')
        ]);

        User::create([
            'name' => 'Hakims',
            'username' => 'hakim',
            'email' => 'hakims@gmail.com',
            'password' => bcrypt('123')
        ]);

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Post::create([
            'title' => 'Judul Pertama',
            'slug' => 'judul-pertama',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae officiis iste inventore ab nobis similique, </p><p>repudiandae officia maxime deserunt expedita! Voluptas quod corrupti nostrum nisi? </p><p>Laborum facere odio fuga!</p>',
            'category_id' => 1,
            'user_id' => 1
        ]);

        Post::create([
            'title' => 'Judul Kedua',
            'slug' => 'judul-kedua',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipi',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae officiis iste inventore ab nobis similique, </p><p>repudiandae officia maxime deserunt expedita! Voluptas quod corrupti nostrum nisi? </p><p>Laborum facere odio fuga!</p>',
            'category_id' => 2,
            'user_id' => 2
        ]);

        Post::create([
            'title' => 'Judul ketiga',
            'slug' => 'judul-ketiga',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipi',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae officiis iste inventore ab nobis similique, </p><p>repudiandae officia maxime deserunt expedita! Voluptas quod corrupti nostrum nisi? </p><p>Laborum facere odio fuga!</p>',
            'category_id' => 1,
            'user_id' => 2
        ]);

        Post::create([
            'title' => 'Judul keempat',
            'slug' => 'judul-keempat',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipi',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae officiis iste inventore ab nobis similique, </p><p>repudiandae officia maxime deserunt expedita! Voluptas quod corrupti nostrum nisi? </p><p>Laborum facere odio fuga!</p>',
            'category_id' => 1,
            'user_id' => 2
        ]);

        Post::create([
            'title' => 'Judul kelima',
            'slug' => 'judul-kelima',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipi',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae officiis iste inventore ab nobis similique, </p><p>repudiandae officia maxime deserunt expedita! Voluptas quod corrupti nostrum nisi? </p><p>Laborum facere odio fuga!</p>',
            'category_id' => 2,
            'user_id' => 1
        ]);
    }
}
