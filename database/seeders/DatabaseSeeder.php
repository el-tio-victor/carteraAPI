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
//         \App\Models\User::factory()->times(3)->hasCartera(1)->create();
      \App\Models\Transaccion::factory()->times(3)->create();
    }
}
