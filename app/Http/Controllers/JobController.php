<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Eloquent\CustomerRepository;
use App\Http\Repositories\Eloquent\JobRepository;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private JobRepository $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /*
     * @return JsonResponse
     * */
    public function index(): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' =>  $this->jobRepository->all()]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


}
