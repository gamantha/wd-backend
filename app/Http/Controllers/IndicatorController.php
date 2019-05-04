<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Builders\ResponseBuilder;
use App\Http\Models\Indicator;
use App\Http\Services\IndicatorService;

class IndicatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $model = new Indicator();
        parent::__construct(new IndicatorService($model));
    }

    public function get(Request $request) {
      $responseBuilder = new ResponseBuilder();
      $page = $request->input('page') ? : 1;
      $limit = $request->input('limit') ? : 10;
      $indicators = $this->service->get($page, $limit);
      $response = $responseBuilder->setData($indicators['data'])->setMessage('fetched indicators')
        ->setTotal($indicators['total'])->setCount($limit)->setPage($page)
        ->setSuccess(true)->build();
      return $response;
    }

    public function find($id) {
      $responseBuilder = new ResponseBuilder();
      $indicator = $this->service->find($id);
      if ($indicator) {
        $response = $responseBuilder->setData($indicator)->setMessage('fetched report indicator')->setSuccess(true)->build();
        return $response;
      } else {
        $response = $responseBuilder->setData($indicator)
            ->setMessage('report indicator with id: ' . $id . ' not found')
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
          'unit_label' => 'required'
        ]);
        $data = new Indicator();
        $data->name = $request->input('name');
        $data->label = $request->input('label');
        $data->unit_label = $request->input('unit_label');
        $indicator = $this->service->save($data);
        $response = $responseBuilder->setData($indicator)->setMessage('indicator created successfully')
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

    public function update(Request $request, $id) {
      $responseBuilder = new ResponseBuilder();
      try {
        $this->validate($request, [
          'name' => 'required',
          'label' => 'required',
          'unit_label' => 'required',
        ]);
        $data = $this->service->find($id);
        if ($data) {
          $data->name = $request->input('name');
          $data->label = $request->input('label');
          $data->unit_label = $request->input('unit_label');
          $indicator = $this->service->save($data);
          $response = $responseBuilder->setData($indicator)->setMessage('indicator updated successfully')
            ->setSuccess(true)->build();
          return $response;
        } else {
          $response = $responseBuilder->setData($indicator)
            ->setMessage('indicator with id' . $id . ' not found')
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

    public function delete($id) {
      $responseBuilder = new ResponseBuilder();
      try {
        $result = $this->service->delete($id);
        if ($result) {
          $response = $responseBuilder->setMessage('indicator deleted successfully')
            ->setSuccess(true)->build();
          return $response;
        } else {
          $response = $responseBuilder->setData($indicator)
            ->setMessage('indicator with id: ' . $id . ' not found')
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
