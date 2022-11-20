<?php

namespace App\Http\Repositories\Eloquent;

use App\Constants\StatusConstants;
use App\Http\Repositories\Interfaces\JobRepositoryInterface;
use App\Models\Job;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    private StatusConstants $statusConstants;
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return Job::where('user_id', auth()->user()->user_id)->with('service', 'customer', 'user', 'vehicleType')->get();
    }

    public function statusUpdate(int $id, array $data): Model
    {
        $status = $data['status'];

        $job = Job::find($id);

        if ($status == StatusConstants::IN_PROCESS)
        {
            $job->update([
                'status' => StatusConstants::IN_PROCESS,
                'start_date' => Carbon::now(),
            ]);
        }elseif ($status == StatusConstants::DONE)
        {
            $job->update([
               'status' => StatusConstants::DONE,
               'start_date' => Carbon::now(),
            ]);
        }elseif ($status == StatusConstants::CANCELLED)
        {
            $job->update([
                'status' => StatusConstants::CANCELLED,
            ]);
        }
        return $job;
    }
}
