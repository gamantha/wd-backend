<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Builders\ResponseBuilder;
use App\Http\Models\Report;
use App\Http\Services\ReportService;
use App\Http\Utils\RequestParser;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $model = new Report();
        parent::__construct(new ReportService($model));
    }

    public function create(Request $request)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'report_template_id' => 'required',
                'report_date' => 'required',
                'name' => 'required',
            ]);
            $report = $this->service->saveReport(
                $request->input('report_template_id'),
                $request->input('name'),
                $request->input('report_date'),
                $request->auth->username,
            );
            // initiate every indicator value
            $response = $responseBuilder->setData($report)->setMessage('report created successfully')
                ->setSuccess(true)->build();
            return $response;
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

    public function get(Request $request)
    {
        $responseBuilder = new ResponseBuilder();
        $page = $request->input('page') ?: 1;
        $limit = $request->input('limit') ?: 10;
        $filter = $request->input('filters') ?: [];
        $filters = RequestParser::parseFilter($filter);
        $sort = $request->input('sort') ?: 'updated_at';
        $sorts = RequestParser::parseSort($sort);
        $report = $this->service->get($page, $limit, $filters, $sorts);
        $response = $responseBuilder->setData($report['data'])->setMessage('fetched report successful')
            ->setTotal($report['total'])->setCount($limit)->setPage($page)
            ->setSuccess(true)->build();
        return $response;
    }

    public function fetchReportingData(Request $request, $id)
    {
        $responseBuilder = new ResponseBuilder();
        $report = $this->service->fetchReportingData($id);
        if (!$report) {
            $response = $responseBuilder->setData($report)
                ->setMessage('report with id: ' . $id . ' not found')
                ->setSuccess(false)->setStatus(404)->build();
            return $response;
        }
        return $responseBuilder->setData($report)
                ->setMessage('report data fetched')
                ->setSuccess(true)->setStatus(200)->build();
    }

    public function find($id)
    {
        $responseBuilder = new ResponseBuilder();
        $report = $this->service->findDetail($id);
        if ($report) {
            $response = $responseBuilder->setData($report)->setMessage('fetched report')->setSuccess(true)->build();
            return $response;
        } else {
            $response = $responseBuilder->setData($report)
                ->setMessage('report with id: ' . $id . ' not found')
                ->setSuccess(false)->setStatus(404)->build();
            return $response;
        }
    }

    public function update(Request $request, $id)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'report_template_id' => 'required',
                'report_date' => 'required',
                'status' => 'required',
                'name' => 'required',
            ]);
            $data = $this->service->find($id);
            if ($data) {
                $data->report_template_id = $request->input('report_template_id');
                $data->report_date = $request->input('report_date');
                $data->status = $request->input('status');
                $data->name = $request->input('name');
                $data->author_id = $request->auth->username;
                $report = $this->service->save($data);
                $response = $responseBuilder->setData($report)->setMessage('report updated successfully')
                    ->setSuccess(true)->build();
                return $response;
            } else {
                $response = $responseBuilder->setData($data)
                    ->setMessage('report with id' . $id . ' not found')
                    ->setSuccess(false)->setStatus(404)->build();
                return $response;
            }
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

    public function delete($id)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            $result = $this->service->delete($id);
            if ($result) {
                $response = $responseBuilder->setMessage('report deleted successfully')
                    ->setSuccess(true)->build();
                return $response;
            } else {
                $response = $responseBuilder->setData($result)
                    ->setMessage('report with id: ' . $id . ' not found')
                    ->setSuccess(false)->setStatus(404)->build();
                return $response;
            }
        } catch (\Exception $e) {
            $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
                ->setSuccess(false)->setStatus(500)->build();
            return $response;
        }
    }
}
