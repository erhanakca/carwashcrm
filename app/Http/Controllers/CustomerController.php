<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Eloquent\CustomerRepository;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\RecordsNotFoundException;


class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' =>  $this->customerRepository->all()]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function save(CustomerRequest $request): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->customerRepository->create($request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function update($customer_id, CustomerRequest $request ): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->customerRepository->update($customer_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }
}
