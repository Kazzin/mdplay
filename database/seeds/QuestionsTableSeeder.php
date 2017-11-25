<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question' => "Cual porcentaje de hogares crees que tiene acceso a la red de agua?",
            'answer' => "93,8%",
            'type' => "percentaje",
        ]);

    }
}
