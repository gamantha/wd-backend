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
        foreach (range(1, 165) as $i) {
            $categoryId = 0;
            if ($i <= 4) {
                $categoryId = 18;
            } elseif ($i <= 19) {
                $categoryId = 19;
            } elseif ($i <= 26) {
                $categoryId = 20;
            } elseif ($i <= 30) {
                $categoryId = 21;
            } elseif ($i <= 34) {
                $categoryId = 22;
            } elseif ($i <= 57) {
                $categoryId = 23;
            } elseif ($i <= 81) {
                $categoryId = 24;
            } elseif ($i <= 89) {
                $categoryId = 25;
            } elseif ($i <= 108) {
                $categoryId = 26;
            } elseif ($i <= 113) {
                $categoryId = 27;
            } elseif ($i <= 124) {
                $categoryId = 28;
            } elseif ($i <= 126) {
                $categoryId = 29;
            } elseif ($i <= 128) {
                $categoryId = 30;
            } elseif ($i <= 133) {
                $categoryId = 31;
            } elseif ($i <= 139) {
                $categoryId = 32;
            } elseif ($i <= 141) {
                $categoryId = 33;
            } elseif ($i <= 143) {
                $categoryId = 34;
            } elseif ($i <= 144) {
                $categoryId = 35;
            } elseif ($i <= 147) {
                $categoryId = 36;
            } elseif ($i <= 150) {
                $categoryId = 37;
            } elseif ($i <= 152) {
                $categoryId = 38;
            } elseif ($i <= 157) {
                $categoryId = 39;
            } elseif ($i <= 165) {
                $categoryId = 40;
            }

            DB::table('report_indicator_map')->insert(
                [
                    [
                        'indicator_id' => $i,
                        'category_id' => $categoryId,
                        'report_template_id' => 3,
                        'order' => 1,
                    ],
                ]
            );
        }
    }
}
