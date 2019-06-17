<?php

namespace App\Http\Services;

use Barryvdh\DomPDF\Facade as PDF;

/**
 * ReportService manage report
 */
class ReportService extends BaseService
{
    function __construct($model)
    {
        parent::__construct($model);
    }

    /**
    * override get method
    * get get all row paginated. Built resource url are: 
    * /resource?filters[key]=value&filters[keyA]=valueA&sort=-Field
    * @param $page Integer page number
    * @param $limit Integer maximum number of item to return
    * @param $condition [Array] conditional : ex: [["name", "Andy"], ["category_id", 1]]
    * @param $sort [Array['key', 'value']] sort by. value being either `ASC` or `DESC`
    * @return ['total', 'data']. total: total of row in the database
    */
    function get($page = 1, $limit = 10, $condition=[], $sort=['created_at', 'DESC']) {
        $total = $this->model::count();
        $data = $this->model::where($condition)->limit($limit)
            ->offset(($page-1)*$limit)->orderBy($sort[0], $sort[1])
            ->with(['template.indicators', 'indicatorValues'])
            ->get()->toArray();
        return [
            'total' => $total,
            'data' => $data,
        ];
    }

    function findDetail($id) {
        $data = $this->model::where(['id' => $id])
            ->with(['template.indicators', 'indicatorValues'])
            ->first();
        if (!$data) {
            return null;
        }
        $response = [];
        $ivs = [];
        foreach($data->indicatorValues as $iv) {
            $ivs[$iv->indicator_id] = $iv;
        }
        $indicators = [];
        foreach($data->template->indicators as $rim) {
            $rim['indicator_value'] = array_key_exists($rim->id, $ivs) ? $ivs[$rim->id]: null;
            array_push($indicators, $rim);
        }
        $data['indicators'] = $indicators;
        unset($data['indicatorValues']); 
        return $data;
    }

    /**
     * exportCsv 
     * @param $id id of report to be exported
     * @return csv file path
     */
    function exportCsv($id) {
        // report generated within the same hour will not be regenerated
        $reportFilePath = \storage_path(date('d-m-Y:H') . '-report-' . $id . '.csv');
        if (file_exists($reportFilePath)) {
            // if report was generated before, no need to extract data
            return $reportFilePath;
        }
        $data = $this->fetchReportingData($id);
        
        if (!$data) {
            return null;
        }
        $this->writeCsv($reportFilePath, $data);
        return $reportFilePath;
    }

    /**
     * exportPdf
     * @param $id id of report to be exported
    * @return pdf file download
     */
    function exportPdf($id) {
        // report generated within the same hour will not be regenerated
        $reportFilePath = \storage_path(date('d-m-Y:H') . '-report-' . $id . '.pdf');
        if (file_exists($reportFilePath)) {
            // if report was generated before, no need to extract data
            return $reportFilePath;
        }
        $data = $this->fetchReportingData($id);
        $result = $this->writePdf($reportFilePath, $data);
        return $result;
    }

    private function fetchReportingData($id) {
        $data = $this->model::where([['id', $id]])
            ->with(['template.indicators', 'indicatorValues'])
            ->orderBy('id', 'ASC')->first();
        if (!$data) {
            return null;
        }
        $ivs = [];
        foreach($data->indicatorValues as $iv) {
            $ivs[$iv->indicator_id] = $iv;
        }
        $indicators = [];
        foreach($data->template->indicators as $rim) {
            $rim['indicator_value'] = array_key_exists($rim->id, $ivs) ? $ivs[$rim->id]: null;
            $rim['order'] = $rim->pivot->order;
            array_push($indicators, $rim);
        }
        $data['indicators'] = $indicators;
        unset($data['indicatorValues']); 
        return $data;
    }


    private function writeCsv($reportFilePath, $data) {
        // open file to write
        $file = fopen($reportFilePath, 'w');
        // write header
        \fputcsv($file, ['report ID', $data['id']]);
        \fputcsv($file, ['author ID', $data['author_id']]);
        \fputcsv($file, ['Report date', $data['report_date']]);
        
        // write column header
        \fputcsv($file, ['No', 'Indicator', 'Value']);
        // write body
        foreach ($data['indicators'] as $rim) {
            \fputcsv($file, [$rim['order'], $rim['label'], $rim['indicator_value']['value']]);
        }
        // close file
        \fclose($file);
        return true;
    }

    private function writePdf($reportFilePath, $data) {
        // open file to write
        $pdf = app('dompdf.wrapper');
        $pdfResult = $pdf->loadView('simple-report-pdf', $data);
        return $pdfResult->download(date('d-m-Y:h') . '-report-pdf-' . $data['id'] . '.pdf');
    }
}
