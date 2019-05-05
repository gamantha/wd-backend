<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illumintae\Validation\ValidationException;
use App\Http\Builders\ResponseBuilder;
use App\Http\Models\Morbidity;
use App\Http\Services\MorbidityService;

class MorbidityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $model = new Morbidity();
        parent::__construct(new MorbidityService($model));
    }

    public function create(Request $request)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'cause' => 'required',
                'gender' => 'required',
                'age' => 'required',
                'report_id' => 'required',
            ]);
            $data = new Morbidity();
            $data->cause = $request->input('cause');
            $data->gender = $request->input('gender');
            $data->age = $request->input('age');
            $data->report_id = $request->input('report_id');
            $morbidity = $this->service->save($data);
            $response = $responseBuilder->setData($morbidity)->setMessage('morbidity created successfully')
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
        $morbidity = $this->service->get($page, $limit);
        $response = $responseBuilder->setData($morbidity['data'])->setMessage('fetched morbidity successful')
            ->setTotal($morbidity['total'])->setCount($limit)->setPage($page)
            ->setSuccess(true)->build();
        return $response;
    }

    public function find($id)
    {
        $responseBuilder = new ResponseBuilder();
        $morbidity = $this->service->find($id);
        if ($morbidity) {
            $response = $responseBuilder->setData($morbidity)->setMessage('fetched morbidity')->setSuccess(true)->build();
            return $response;
        } else {
            $response = $responseBuilder->setData($morbidity)
                ->setMessage('morbidity with id: ' . $id . ' not found')
                ->setSuccess(false)->setStatus(404)->build();
            return $response;
        }
    }

    public function update(Request $request, $id)
    {
        $responseBuilder = new ResponseBuilder();
        try {
            $this->validate($request, [
                'cause' => 'required',
                'gender' => 'required',
                'age' => 'required',
                'report_id' => 'required',
            ]);
            $data = $this->service->find($id);
            if ($data) {
                $data->cause = $request->input('cause');
                $data->gender = $request->input('gender');
                $data->age = $request->input('age');
                $data->report_id = $request->input('report_id');
                $morbidity = $this->service->save($data);
                $response = $responseBuilder->setData($morbidity)->setMessage('morbidity updated successfully')
                    ->setSuccess(true)->build();
                return $response;
            } else {
                $response = $responseBuilder->setData($data)
                    ->setMessage('morbidity with id' . $id . ' not found')
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
                $response = $responseBuilder->setMessage('morbidity deleted successfully')
                    ->setSuccess(true)->build();
                return $response;
            } else {
                $response = $responseBuilder->setData($result)
                    ->setMessage('morbidity with id: ' . $id . ' not found')
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
