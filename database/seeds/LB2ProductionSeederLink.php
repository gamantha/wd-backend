<?php

use Illuminate\Database\Seeder;

class LB2ProductionSeederLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create report template
        DB::table('report_template')->insert(
            [
                'id' => 2,
                'name' => 'LB2',
                'label' => 'LB2',
                'author_id' => 'andy-shi88',
                'report_type' => 'monthly',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        );
        $indicators = DB::table('indicator')->where('id', '>=', 3000)->get();
        $mapToSave = [];
        foreach($indicators as $index => $indicator) {
            array_push($mapToSave, [
                'indicator_id' => $indicator->id,
                'report_template_id' => 2,
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
