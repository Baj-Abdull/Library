<?php

namespace Database\Seeders;

use App\Models\Librarian;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Book::factory(1)->create();

        DB::table('librarians')->insert([
            'name' => 'test',
            'email' => 'test3@gmail.com',
            'password' => bcrypt('test1234'),
            'created_at' => date_create(),
            'updated_at' => date_create(),
	        ]);

    }
}
