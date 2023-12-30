<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Database\Factories\BookFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Book::factory()->count(33)->has(Review::factory()->count(rand(5, 30))->good())->create();
        Book::factory()->count(33)->has(Review::factory()->count(rand(5, 30))->average())->create();
        Book::factory()->count(33)->has(Review::factory()->count(rand(5, 30))->bad())->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
