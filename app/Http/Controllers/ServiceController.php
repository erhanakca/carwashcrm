<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Eloquent\ServiceRepository;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Http\Requests\ServiceBulkUpdateRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        try {
            return response()->json(['success' => true, 'data' =>  $this->serviceRepository->all()]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function save(ServiceRequest $request)
    {
        try {
            return response()->json(['success' => true, 'data' => $this->serviceRepository->create($request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function update($service_id, ServiceRequest $request)
    {
        try {
            return response()->json(['success' => true, 'data' => $this->serviceRepository->update($service_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function bulkUpdate(Request $request)
    {
        try {
        $data = $request->all();
        foreach ($data as $item)
        {
            $update_data = ['name' => $item['name'], 'price' => $item['price'], 'cost' => $item['cost'] ];

            $this->serviceRepository->update($item['service_id'], $update_data);
        }
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }

        return response()->json(['success' => true, $data], 200);
    }

}
