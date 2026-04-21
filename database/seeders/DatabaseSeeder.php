<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        Category::create(['name' => 'Fantasy', 'description' => 'Fantasy books']);
        Category::create(['name' => 'Romance', 'description' => 'Romance books']);
        Category::create(['name' => 'Horror', 'description' => 'Horror books']);
        Category::create(['name' => 'Mystery', 'description' => 'Mystery books']);
        Category::create(['name' => 'Classic', 'description' => 'Classic literature']);
        Category::create(['name' => 'Adventure', 'description' => 'Adventure books']);
        Category::create(['name' => 'Science Fiction', 'description' => 'Sci-Fi books']);
        Category::create(['name' => 'Biography', 'description' => 'Biography books']);
        Category::create(['name' => 'History', 'description' => 'History books']);
        Category::create(['name' => 'Self-Help', 'description' => 'Self-help books']);

        Author::factory(100)->create();
        Book::factory(1000)->create();
    }
}
