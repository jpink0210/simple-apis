<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 這裡是系統原本的提示，告訴你要自己 import Model 來操作
        // \App\Models\User::factory(10)->create();

        // $this->call(ProductSeeder::class); 可以互 call 其他 seeder
        $this->call(ProductSeeder::class);
        $this->call(ImageSeeder::class);

    }
}
