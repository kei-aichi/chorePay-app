<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        Category::factory(5)
            ->for($user)
            ->create()
            ->each(function ($category) use ($user) {

                Task::factory(5)
                    ->create([
                        'user_id' => $user->id,
                        'category_id' => $category->id,
                    ]);
            });
    }
}
