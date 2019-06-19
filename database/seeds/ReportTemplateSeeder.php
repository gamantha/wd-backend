<?php

use Illuminate\Database\Seeder;

class ReportTemplateSeeder extends Seeder
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
                [
                    // 'id' => 1,
                    'name' => 'Laporan Bulanan (LB1)',
                    'label' => 'Laporan Bulanan (LB1)',
                    'report_type' => 'monthly',
                    'author_id' => 'admin',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    // 'id' => 2,
                    'name' => 'Laporan Bulanan (LB2)',
                    'label' => 'Laporan Bulanan (LB2)',
                    'author_id' => 'admin',
                    'report_type' => 'monthly',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    // 'id' => 3,
                    'name' => 'Laporan Bulanan (LB3)',
                    'label' => 'Laporan Bulanan (LB3)',
                    'author_id' => 'admin',
                    'report_type' => 'monthly',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    // 'id' => 4,
                    'name' => 'Laporan Bulanan (LB4)',
                    'label' => 'Laporan Bulanan (LB4)',
                    'author_id' => 'admin',
                    'report_type' => 'monthly',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );
    }
}
