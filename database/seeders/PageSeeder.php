<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('pages')->insert(array(
            'url' => 'https://github.com',
            'title' => 'Github',
            'created_at' => date('Y-m-d H:i:s'),
            'favorite' => true,
            'icon' => 'https://github.githubassets.com/assets/GitHub-Logo-ee398b662d42.png',
            'user_id' => 1,
            'tag_id' => 1,
        ));
        DB::table('pages')->insert(array(
            'url' => 'https://plantespourtous.co',
            'created_at' => date('Y-m-d H:i:s'),
            'title' => 'Plantes Pour Tous',
            'favorite' => false,
            'icon' => 'https://www.google.com/s2/favicons?domain=plantespourtous.co&sz=64',
            'user_id' => 1,
            'tag_id' => 1,
        ));
    }
}
