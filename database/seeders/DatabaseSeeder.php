<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostDetail;
use App\Models\User;
use App\Models\SearchTraffic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // User::create([
        //     'name' => 'Harry Muliawan',
        //     'email' => 'harrymuliawan@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'Anisah Rizkiani',
        //     'username' => 'arizkiani',
        //     'email' => 'anisah.rizkiani@gmail.com',
        //     'password' => bcrypt('12345'),
        //     'is_admin' => 1
        // ]);

        // User::factory(10)->create();
        
        // SearchTraffic::create([
        //     'keyword' => 'voluptae'
        // ]);
        
        // Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // Category::create([
        //     'name' => 'Web Programming',
        //     'slug' => 'web-programming'
        // ]);

        // Category::create([
        //     'name' => 'Web Design',
        //     'slug' => 'web-design'
        // ]);

        Post::factory(10)->create();
        PostDetail::factory(10)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis eum magni optio fuga porro quo dicta cumque doloremque, consectetur cum aspernatur tempora sunt nesciunt ducimus, maxime natus quod officia, recusandae corporis culpa rem reiciendis nihil et? Magni molestiae odit consectetur ratione nisi quasi possimus, corrupti temporibus. Debitis magnam fugiat nam quos, error cumque fuga neque? Quaerat ex eum dignissimos corrupti, consequuntur error nobis minus dolorum eveniet officia quae repudiandae assumenda velit? Deserunt voluptatibus provident beatae laudantium inventore ullam fugit quod non, ad dolorem accusantium similique nostrum dolore, hic nulla. Voluptates ea error impedit ratione vero? Doloribus, debitis quidem? Voluptatum, amet.',
        //     'category_id' => '1',
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis eum magni optio fuga porro quo dicta cumque doloremque, consectetur cum aspernatur tempora sunt nesciunt ducimus, maxime natus quod officia, recusandae corporis culpa rem reiciendis nihil et? Magni molestiae odit consectetur ratione nisi quasi possimus, corrupti temporibus. Debitis magnam fugiat nam quos, error cumque fuga neque? Quaerat ex eum dignissimos corrupti, consequuntur error nobis minus dolorum eveniet officia quae repudiandae assumenda velit? Deserunt voluptatibus provident beatae laudantium inventore ullam fugit quod non, ad dolorem accusantium similique nostrum dolore, hic nulla. Voluptates ea error impedit ratione vero? Doloribus, debitis quidem? Voluptatum, amet.',
        //     'category_id' => '1',
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis eum magni optio fuga porro quo dicta cumque doloremque, consectetur cum aspernatur tempora sunt nesciunt ducimus, maxime natus quod officia, recusandae corporis culpa rem reiciendis nihil et? Magni molestiae odit consectetur ratione nisi quasi possimus, corrupti temporibus. Debitis magnam fugiat nam quos, error cumque fuga neque? Quaerat ex eum dignissimos corrupti, consequuntur error nobis minus dolorum eveniet officia quae repudiandae assumenda velit? Deserunt voluptatibus provident beatae laudantium inventore ullam fugit quod non, ad dolorem accusantium similique nostrum dolore, hic nulla. Voluptates ea error impedit ratione vero? Doloribus, debitis quidem? Voluptatum, amet.',
        //     'category_id' => '2',
        //     'user_id' => 2
        // ]);
    }
}