<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        // $this->call(SettingTableSeeder::class);
        
        Admin::firstOrCreate([
            'email' => 'jahidmahmud78@gmail.com'
        ], [
            'name' => 'Jahid Mahmud',
            'email' => 'jahidmahmud78@gmail.com',
            'password' => bcrypt('111111'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
