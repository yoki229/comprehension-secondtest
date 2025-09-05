<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //シーディング前に一度データをクリア
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_season')->truncate();
        Season::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //季節情報(春・夏・秋・冬)のダミーデータ4件
        $seasons = ['春','夏','秋','冬'];


    }
}
