<?php

use Illuminate\Database\Seeder;

class LB3ProductionSeederLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_template')->insert(
            [
                'id' => 3,
                'name' => 'LB3',
                'label' => 'LB3',
                'author_id' => 'andy-shi88',
                'report_type' => 'monthly',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        );
        $indicators = DB::table('indicator')->where('id', '>=', 3500)->get();
        $mapToSave = [];
        foreach($indicators as $index => $indicator) {
            array_push($mapToSave, [
                'indicator_id' => $indicator->id,
                'report_template_id' => 3,
                'category_id' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'order' => $index,
                ]
            );
        }
        DB::table('report_indicator_map')->insert(
            $mapToSave
        );
    }
}
