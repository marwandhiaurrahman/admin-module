<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\DatabaseSeeder as SeedsDatabaseSeeder;
use Modules\Siswa\Database\Seeders\SiswaDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SeedsDatabaseSeeder::class);
    }
}

