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
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            'question' => "¿Crees que la cantidad de accidentes de transito disminuyó a lo largo del año 2011 al 2012?",
            'answer' => "No",
            'type' => "yes/no",
        ]);
        DB::table('questions')->insert([
            'question' => "¿Qué porcentaje de hogares crees que tiene acceso a la red de agua?",
            'answer' => "93,8%",
            'type' => "percentage",
        ]);
        DB::table('questions')->insert([
            'question' => "El turismo ascendió drasticamente entre el año 2011 al año 2015",
            'answer' => "false",
            'type' => "true/false",
        ]);
    }
}
