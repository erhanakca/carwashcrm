<?php

namespace App\Http\Controllers;

use App\Constants\StatusConstants;
use App\Http\Repositories\Eloquent\JobRepository;
use App\Http\Requests\FilterByDateRequest;
use App\Http\Requests\FilterJobsStatusRequest;
use App\Http\Requests\FilterJobsRequest;
use App\Http\Requests\JobRequest;
use App\Http\Requests\JobUpdateStatusRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;


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

    public function save(JobRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['status'] = StatusConstants::PENDING;
            $data['user_id'] = auth()->user()->user_id;
            return response()->json(['success' => true, 'data' => $this->jobRepository->create($data)]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function updateStatus($job_id, JobUpdateStatusRequest $request): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->jobRepository->statusUpdate($job_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function delete($job_id): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->jobRepository->delete($job_id)]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function updateJob($job_id, JobUpdateRequest $request): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->jobRepository->jobUpdate($job_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function filterByDate(FilterByDateRequest $request): JsonResponse
    {
        try {
            $data = $this->jobRepository->filterByDate($request->validated());
            if ($data->count() > 0) {
                return response()->json(['success' => true, 'data' => $data]);
            } else {
                return response()->json(['success' => true, 'message' => 'There is no job between these dates']);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function filterJobsStatus(FilterJobsStatusRequest $request): JsonResponse
    {
        try {
            $status_id = $request->validated()['status'];
            $data = $this->jobRepository->filterJobsStatus($status_id);

            if ($data->count() > 0) {
                return response()->json(['success' => true, 'data' => $data]);
            } else {
                return response()->json(['success' => true, 'message' => 'No job in this status!']);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function filterJobs(FilterJobsRequest $request): JsonResponse
    {
        try {

            $data = $this->jobRepository->filterJobs($request->validated());
            if ($data->count() > 0) {
                return response()->json(['success' => true, 'data' => $data]);
            } else {
                return response()->json(['success' => true, 'message' => 'No job in this status!']);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


}
