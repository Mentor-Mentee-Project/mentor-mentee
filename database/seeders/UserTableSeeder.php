<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'sub' => 'abcdefghijklmn',
                    'is_mentor' => 't',
                    'nickname' => 'yutanakno_jp',
                    'name' => 'Yuta Nakano',
                    'picture' => 'https://pbs.twimg.com/profile_images/1302942354848923650/BH4TDvNq_400x400.jpg',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}