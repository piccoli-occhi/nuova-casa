<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('newsletters')->insertOrIgnore(array(
            array(
                'title' => 'Jster',
                'url' => 'https://jster.net/atom.xml',
                'user_id' => 1,
            ),
            array(
                'title' => 'JavaScript Weekly',
                'url' => 'https://cprss.s3.amazonaws.com/javascriptweekly.com.xml',
                'user_id' => 1,
            ),
            array(
                'title' => 'Frontend Focus',
                'url' => 'https://us15.campaign-archive.com/feed?u=dbfcd660859177225962fa83e&id=a94ca11274',
                'user_id' => 1,
            ),
        ));
    }
}
