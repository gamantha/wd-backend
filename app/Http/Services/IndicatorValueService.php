<?php

namespace App\Http\Services;

use App\Http\Models\IndicatorValue;

/**
 * IndicatorValueService manage report value
 */
class IndicatorValueService extends BaseService {

    function __construct($model) {
        parent::__construct($model);
    }

    /**
     * insert multiple report values
     * @param values
     */
    function insertValues($values, $indicators, $report_id) {
        $indicatorIds = array_column($indicators->toArray(), 'id');
        // run in db-transaction in case on of indicators fail
        \DB::transaction(function() use ($values, $indicatorIds, $report_id) {
            foreach ($values as $value) {
                if (in_array($value['indicator_id'], $indicatorIds)) {
                    $indicatorValue = new IndicatorValue();
                    $indicatorValue->value = $value['indicator_value'];
                    $indicatorValue->indicator_id = $value['indicator_id'];
                    $indicatorValue->report_id = $report_id;
                    $indicatorValue->save();
                } else {
                    // roll back when fail
                    \DB::rollBack();
                    \Log::warning("invalid indicator provided : rolling back applied changes");
                    throw new \Exception("InvalidIndicator", 1);
                }
            }
        });
    }

}
