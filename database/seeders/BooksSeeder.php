<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faker with Indonesian locale
        $faker = Faker::create('id_ID');
        // Books (Buku)
        echo "Membuat 100.000 buku...\n";
        $batchSizeBook = 1000;
        $authorIds = Author::pluck('id');
        $categoryIds = Categories::pluck('id');
        $books = [];
        for ($i = 1; $i <= 100000; $i++) {
            $books[] = [
                'book_title'   => ucfirst($faker->realText(rand(20, 50))), // Judul buku acak
                'author_id'    => $authorIds->random(),
                'category_id'  => $categoryIds->random(),
                'published_at' => $faker->date(), // Format YYYY-MM-DD
                'created_at'   => now(),
                'updated_at'   => now()
            ];
            if (count($books) >= $batchSizeBook) {
                DB::table('books')->insert($books);
                $books = [];
            }
        }
        if (!empty($books)) DB::table('books')->insert($books);

        echo "✅ Seeder selesai.\n";
    }
}
