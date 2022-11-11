<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Eloquent\ServiceRepository;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
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
}
