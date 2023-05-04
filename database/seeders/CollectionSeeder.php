<?php

namespace Database\Seeders;

use App\Models\Collection;
use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('collections')->insert([
            ['name' => 'Getting Started', 'slug' => 'getting-started', 'description' => 'Getting started with Ticksify', 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()],
            ['name' => 'Envato Integration', 'slug' => 'api', 'envato-integration' => 'Learn how to integrate with Envato API', 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()],
            ['name' => 'Customization', 'slug' => 'customization', 'description' => 'Learn how to customize Ticksify', 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()],
            ['name' => 'Troubleshooting', 'slug' => 'troubleshooting', 'description' => 'Learn how to troubleshoot Ticksify', 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()],
            ['name' => 'Changelog', 'slug' => 'changelog', 'description' => 'Ticksify Changelog', 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()],
        ]);
//        Collection::factory(20)->create();
    }
}
