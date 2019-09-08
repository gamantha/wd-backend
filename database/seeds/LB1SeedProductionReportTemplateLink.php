<?php

use Illuminate\Database\Seeder;

class LB1SeedProductionReportTemplateLink extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicators = DB::table('indicator')->get();
        $mapToSave = [];
        foreach($indicators as $index => $indicator) {
            array_push($mapToSave, [
                'indicator_id' => $indicator->id,
                'report_template_id' => 1,
                'category_id' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'order' => $index,
            ],);
        }
        DB::table('report_indicator_map')->insert(
            $mapToSave
        );
    }
}
