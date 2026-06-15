<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Init admin user
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => \Hash::make('secret'),
        ]);

        // Init categories
        foreach (['Laravel', 'PHP', 'HTML', 'CSS'] as $name) {
            if (!Category::where('name', $name)->exists()) {
                $category = new Category();
                $category->name = $name;
                $category->save();
            }
        }

        // Init tags
        foreach (['tutorial', 'thoughts', 'notes', 'life'] as $name) {
            if (!Tag::where('name', $name)->exists()) {
                $tag = new Tag;
                $tag->name = $name;
                $tag->save();
            }
        }
    }
}
