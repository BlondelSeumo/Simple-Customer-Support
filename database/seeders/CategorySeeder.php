<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::upsert([
            [
                'name' => 'Sales question',
                'slug' => 'sales-question',
                'description' => 'Sales related questions',
                'is_license_required' => false,
            ], [
                'name' => 'Bug report',
                'slug' => 'bug-report',
                'description' => 'Report a bug',
                'is_license_required' => false,
            ], [
                'name' => 'Feature request',
                'slug' => 'feature-request',
                'description' => 'Request a new feature',
                'is_license_required' => true,
            ], [
                'name' => 'How to',
                'slug' => 'how-to',
                'description' => 'How to do something',
                'is_license_required' => true,
            ], [
                'name' => 'Technical Issue',
                'slug' => 'technical-issue',
                'description' => 'Technical issue',
                'is_license_required' => true,
            ], [
                'name' => 'Other',
                'slug' => 'other',
                'description' => 'Other',
                'is_license_required' => true,
            ],
        ], 'slug');
    }
}
