<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $company = User::create([
            'first_name' => 'Company',
            'last_name' => 'User',
            'email' => 'company@example.com',
            'password' => bcrypt('password'),
            'role' => 'company',
        ]);

        User::factory(10)->create(['role' => 'player']);

        $genres = ['Action', 'Adventure', 'RPG', 'Strategy', 'Simulation', 'Sports', 'Puzzle', 'Horror'];
        $categories = collect();

        foreach ($genres as $genre) {
            $categories->push(Category::create(['name' => $genre, 'slug' => Str::slug($genre)]));
        }

        $games = Game::factory(20)->create(['developer_id' => $company->id, 'status' => 'approved']);
        
        foreach ($games as $game) {
            $game->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
