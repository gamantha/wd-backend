<?php

use Illuminate\Database\Seeder;

class ReportIndicatorMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,165) as $i){
            DB::table('report_indicator_map')->insert(
                [
                    [
                        'indicator_id' => $i,
                        'report_template_id' => 3,
                        'order' => 1,
                    ],
                ]
            );
        }
    }
}
