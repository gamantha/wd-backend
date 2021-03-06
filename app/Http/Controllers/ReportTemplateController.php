<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Models\Indicator;
use App\Http\Services\IndicatorService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Builders\ResponseBuilder;
use App\Http\Models\ReportTemplate;
use App\Http\Services\ReportTemplateService;

class ReportTemplateController extends Controller
{

    private $indicatorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $model = new ReportTemplate();
        $indicator = new Indicator();
        $this->indicatorService = new IndicatorService($indicator);
        parent::__construct(new ReportTemplateService($model));
    }

    public function get(Request $request) {
      $responseBuilder = new ResponseBuilder();
      $page = $request->input('page') ? : 1;
      $limit = $request->input('limit') ? : 10;
      $reportTemplates = $this->service->get($page, $limit);
      $response = $responseBuilder->setData($reportTemplates['data'])->setMessage('fetched report template')
        ->setTotal($reportTemplates['total'])->setCount($limit)->setPage($page)
        ->setSuccess(true)->build();
      return $response;
    }

    public function find($id) {
      $responseBuilder = new ResponseBuilder();
      $reportTemplate = $this->service->find($id);
      if ($reportTemplate) {
        $response = $responseBuilder->setData($reportTemplate)->setMessage('fetched report template')->setSuccess(true)->build();
        return $response;
      } else {
        $response = $responseBuilder->setData($reportTemplate)
            ->setMessage('report template with id: ' . $id . ' not found')
            ->setSuccess(false)->setStatus(404)->build();
        return $response;
      }
    }

    public function getIndicators($id) {
      $responseBuilder = new ResponseBuilder();
      $reportTemplate = $this->service->find($id);
      if ($reportTemplate) {
          $limit = 1000;
          $page = 1;
          $indicators = $reportTemplate->indicators()->get();
          $response = $responseBuilder->setData($indicators)->setMessage('fetched report template indicators indicators')
              ->setSuccess(true)->build();
            return $response;
      } else {
          $response = $responseBuilder->setData($reportTemplate)
              ->setMessage('report template with id: ' . $id . ' not found')
              ->setSuccess(false)->setStatus(404)->build();
          return $response;
      }
    }
    
    public function create(Request $request) {
      $responseBuilder = new ResponseBuilder();
      try {
        $this->validate($request, [
          'name' => 'required',
          'label' => 'required',
          'report_type' => 'required',
          'indicator_ids' => 'required|array',
          'category_ids' => 'required|array',
        ]);
        $reportTemplate = $this->service->saveReportTemplate($request);
        $response = $responseBuilder->setData($reportTemplate)->setMessage('report template created successfully')
          ->setSuccess(true)->build();
        return $response;
      } catch (ValidationException $e) {
        Log::warning($e);
        $response = $responseBuilder->setData($e->response->original)->setMessage("invalid payload provided")
          ->setSuccess(false)->setStatus(422)->build();
        return $response;
      } catch (\Exception $e) {
        Log::warning($e);
        $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
          ->setSuccess(false)->setStatus(500)->build();
        return $response;
      }
    }

    public function update(Request $request, $id) {
      $responseBuilder = new ResponseBuilder();
      try {
        $this->validate($request, [
          'name' => 'required',
          'label' => 'required',
          'report_type' => 'required',
          'indicator_ids' => 'required|array'
        ]);
        $data = $this->service->find($id);
        if ($data) {
          $reportTemplate = $this->service->updateReportTemplate($request, $data, $id);
          $response = $responseBuilder->setData($reportTemplate)->setMessage('report template updated successfully')
            ->setSuccess(true)->build();
          return $response;
        } else {
          $response = $responseBuilder->setData(null)
            ->setMessage('report template with id ' . $id . ' not found')
            ->setSuccess(false)->setStatus(404)->build();
          return $response;
        }
      } catch (ValidationException $e) {
        Log::warning($e);
        $response = $responseBuilder
          ->setData($e->response->original)->setMessage("invalid payload provided")
          ->setSuccess(false)->setStatus(422)->build();
        return $response;
      } catch (\Exception $e) {
        dd($e);
        Log::warning($e);
        $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
          ->setSuccess(false)->setStatus(500)->build();
        return $response;
      }
    }

    public function delete($id) {
      $responseBuilder = new ResponseBuilder();
      try {
        $result = $this->service->delete($id);
        if ($result) {
          $response = $responseBuilder->setMessage('report template deleted successfully')
            ->setSuccess(true)->build();
          return $response;
        } else {
          $response = $responseBuilder->setData($reportTemplate)
            ->setMessage('report template with id: ' . $id . ' not found')
            ->setSuccess(false)->setStatus(404)->build();
          return $response;
        }
      } catch (\Exception $e) {
        Log::warning($e);
        $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
          ->setSuccess(false)->setStatus(500)->build();
        return $response;
      }
    }
}
