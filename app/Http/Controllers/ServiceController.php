<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Eloquent\ServiceRepository;
use App\Http\Requests\ServiceRequest;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }


    public function index(): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' =>  $this->serviceRepository->all()]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


    public function save(ServiceRequest $request): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->serviceRepository->create($request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


    public function update($service_id, ServiceRequest $request): JsonResponse
    {
        try {
            $this->serviceRepository->delete($service_id);
            return response()->json(['success' => true, 'data' => $this->serviceRepository->create($request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


    public function bulkUpdate(Request $request): JsonResponse
    {
        try {
        $data = $request->all();
        foreach ($data as $item)
        {
            $validator = Validator::make($item, [
                'name' => 'required',
                'price' => 'required|integer',
                'cost' => 'required|integer|lt:price'
            ]);

            if($validator->fails()){
               throw new \Exception($validator->errors()->first(), 404);
            }

            $this->serviceRepository->delete($item['service_id']);
            $update_data = ['name' => $item['name'], 'price' => $item['price'], 'cost' => $item['cost'] ];

            $this->serviceRepository->create($update_data);
        }
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
        return response()->json(['success' => true, $data], 200);
    }


    public function delete($service_id): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->serviceRepository->delete($service_id)]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }
}
