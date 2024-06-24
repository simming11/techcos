<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grant;
use App\Models\Tag;

class GrantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some tags
        $tags = Tag::factory()->count(5)->create();

        // Create some grants and attach tags
        Grant::factory()->count(10)->create()->each(function ($grant) use ($tags) {
            $grant->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
