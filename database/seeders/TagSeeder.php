<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('tags')->insert(array(
            'name' => 'Plante Pour Tous',
            'created_at' => date('Y-m-d H:i:s'),
            'icon' => 'https://www.google.com/s2/favicons?domain=plantespourtous.co&sz=64',
            'user_id' => 1,
        ));
    }
}
