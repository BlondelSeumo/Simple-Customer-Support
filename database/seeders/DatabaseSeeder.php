<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            AgentSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CollectionSeeder::class,
            ArticleSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            LabelSeeder::class,
            TicketSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
