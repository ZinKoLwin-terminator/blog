<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Blog;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create();
        $frontend = Category::factory()->create(['name' => 'frontend']);
        $backend = Category::factory()->create(['name' => 'backend']);
        Blog::factory(2)->create(['category_id' => $frontend->id]);
        Blog::factory(2)->create(['category_id' => $backend->id]);
    }
}
