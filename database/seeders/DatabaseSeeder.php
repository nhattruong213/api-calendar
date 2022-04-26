<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        DB::table('dates')->insert([ 
            [
                'date' => 'Fri Apr 15 2022'
            ],
            [   
                'date' => 'Tue Apr 19 2022'
            ],
        ]);
        DB::table('contents')->insert([ 
            [
                'date_id' => 1,
                'content' => 'Đá bóng'
            ],
            [   
                'date_id' => 1,
                'date' => 'Xem phim'
            ],
            [
                'date_id' => 2,
                'content' => 'Đá bóng'
            ],
            [   
                'date_id' => 2,
                'date' => 'Xem phim'
            ],
        ]);
        DB::table('tasks')->insert([ 
            [
                'content' => 'Đá bóng',
                'date' => 'Fri Apr 15 2022'
            ],
            [   
                'content' => 'Xem phim',
                'date' => 'Fri Apr 15 2022'
            ],
            [
                'content' => 'Đá bóng',
                'date' => 'Tue Apr 19 2022'
            ],
            [   
                'content' => 'Xem phim',
                'date' => 'Tue Apr 19 2022'
            ],
        ]);
    }
}
