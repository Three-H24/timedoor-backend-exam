<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faker with Indonesian locale
        $faker = Faker::create('id_ID');

        // Categories (Kategori Buku)
        echo "Membuat 3000 kategori buku...\n";
        $batchSizeCategory = 1000;
        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = [
                'category'   => ucfirst($faker->word),
                'created_at' => now(),
                'updated_at' => now()
            ];

            if (count($categories) >= $batchSizeCategory) {
                DB::table('categories')->insert($categories);
                $categories = [];
            }
        }
        if(!empty($categories)) DB::table('categories')->insert($categories);

        echo "✅ Seeder selesai.\n";
    }
}
