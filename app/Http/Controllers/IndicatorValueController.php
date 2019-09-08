<?php


namespace App\Http\Controllers;


use App\Http\Builders\ResponseBuilder;
use App\Http\Models\Indicator;
use App\Http\Models\IndicatorValue;
use App\Http\Models\Report;
use App\Http\Models\ReportTemplate;
use App\Http\Services\IndicatorService;
use App\Http\Services\IndicatorValueService;
use App\Http\Services\ReportTemplateService;
use Illuminate\Http\Request;

class IndicatorValueController extends Controller
{

    private $indicatorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->indicatorService = new IndicatorService(new Indicator());
        $this->reportTemplateService = new ReportTemplateService(new ReportTemplate());
        $this->reportService = new IndicatorService(new Report());
        parent::__construct(new IndicatorValueService(new IndicatorValue()));
    }

    public function update(Request $request) {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'indicators' => 'required|array'
            ]);
            $this->service->updateValues($request->input('indicators'));
            return $responseBuilder->setMessage("indicator values updated")->setSuccess(true)->setStatus(200)->build();
        } catch (ValidationException $e) {
            $response = $responseBuilder->setMessage("invalid payload provided")
                ->setSuccess(false)->setStatus(422)->build();
            return $response;
        } catch (\Exception $e) {
            $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
                ->setSuccess(false)->setStatus(500)->build();
            return $response;
        }
    }

    public function create(Request $request)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            // validate request payload
            $this->validate($request, [
                'report_values',
                'report_id',
                'status',
                'report_values.*.indicator_id',
                'report_values.*.indicator_values'
            ]);
            // fetch indicator related to report_id
            $report = $this->reportService->find($request->input('report_id'));
            if ($report == null) {
                $response = $responseBuilder->setData($report)
                    ->setMessage('report with id: ' . $request->input('report_id') . ' not found')
                    ->setSuccess(false)->setStatus(404)->build();
                return $response;
            }

            $report_template = $this->reportTemplateService->find($report->report_template_id);
            $indicators = $report_template->indicators()->get();
            $values = $request->input('report_values');
            $this->service->insertValues($values, $indicators, $report->id, $request->input('status'));
            $response = $responseBuilder->setData($values)->setMessage('report value inserted successfully')
                ->setSuccess(true)->build();
            return $response;
        } catch (ValidationException $e) {
            $response = $responseBuilder->setMessage("invalid payload provided")
                ->setSuccess(false)->setStatus(422)->build();
            return $response;
        } catch (\Exception $e) {
            if ($e->getMessage() == 'InvalidIndicator') {
                $response = $responseBuilder->setMessage("invalid indicator provided")
                    ->setSuccess(false)->setStatus(500)->build();
                return $response;    
            } else {
                $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
                    ->setSuccess(false)->setStatus(500)->build();
                return $response;
            }
        }
    }
}