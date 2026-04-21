<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $categoryCount = Category::count();
        
        return [
            'title' => fake()->sentence(3),
            'isbn' => fake()->unique()->isbn13(),
            'published_year' => fake()->year(),
            'author_id' => Author::factory(),
            'category_id' => fake()->numberBetween(1, $categoryCount > 0 ? $categoryCount : 1),
        ];
    }
}