<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Services\ChartService;
use App\Http\Builders\ResponseBuilder;
use App\Http\Utils\RequestParser;

use App\Http\Models\Chart;

class ChartController extends Controller
{
    public function __construct() {
        parent::__construct(new ChartService(new Chart()));
    }

    public function create(Request $request) {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'from' => 'required|date',
                'to' => 'required|date',
                'interval' => 'required|in:day,week,month,year',
                'indicator_ids' => 'required|array'
            ]);
            $chart = $this->service->saveChart($request);
            $response = $responseBuilder->setData($chart)->setMessage('chart created successfully')
                ->setSuccess(true)->build();
            return $response;
        } catch (ValidationException $e) {
            $response = $responseBuilder->setData($e->response->original)->setMessage("invalid payload provided")
                ->setSuccess(false)->setStatus(422)->build();
            return $response;
        } catch (\Exception $e) {
            $response = $responseBuilder->setMessage("unknown error occured: contact your administrator")
                ->setSuccess(false)->setStatus(500)->build();
            return $response;
        }
        return $responseBuilder->build();
    }

    public function get(Request $request) {
        $responseBuilder = new ResponseBuilder();
        $page = $request->input('page') ?: 1;
        $limit = $request->input('limit') ?: 10;
        $filter = $request->input('filters') ?: [];
        $filters = RequestParser::parseFilter($filter);
        $sort = $request->input('sort') ?: 'updated_at';
        $sorts = RequestParser::parseSort($sort);
        $charts = $this->service->get($page, $limit, $filters, $sorts);
        $response = $responseBuilder->setData($charts['data'])->setMessage('fetched report successful')
            ->setTotal($charts['total'])->setCount($limit)->setPage($page)
            ->setSuccess(true)->build();
        return $response;
    }
}