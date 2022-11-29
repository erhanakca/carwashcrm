<?php

namespace App\Http\Repositories\Eloquent;

use App\Constants\StatusConstants;
use App\Http\Repositories\Interfaces\JobRepositoryInterface;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;


class JobRepository extends BaseRepository implements JobRepositoryInterface
{
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


    public function jobUpdate(int $id, array $update): Model
    {
        $job = Job::find($id);
        if ($update['status'] == StatusConstants::PENDING)
        {
            $job->update([
                'service_id' => $update['service_id'],
                'customer_id' => $update['customer_id'],
                'vehicle_type_id' => $update['vehicle_type_id'],
                'status' => $update['status'],
                'plate_number' => $update['plate_number'],
            ]);
            $job->start_date = null;
            $job->end_date = null;
            $job->save();
        }else
        {
            $job->update([
                'service_id' => $update['service_id'],
                'customer_id' => $update['customer_id'],
                'vehicle_type_id' => $update['vehicle_type_id'],
                'status' => $update['status'],
                'plate_number' => $update['plate_number']
            ]);
        }
        return $job;
    }


    public function filterByDate(array $date): Collection
    {
        $start_date = Carbon::parse($date['start_date']);
        $end_date = Carbon::parse($date['end_date']);

        return Job::all()->filter(function ($item) use($start_date, $end_date){
            if ($item->start_date >= $start_date && $item->end_date <= $end_date){
                return $item;
            }
        });
    }

    public function filterJobsStatus(int $status): Collection
    {
        return Job::where('status', $status)->get();
    }


    public function filterJobs(array $data): Collection
    {
        $status = $data['status'];
        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);
        $jobs = Job::where('status', $status)->get();

        return $jobs->filter(function ($item) use($start_date, $end_date){
            if ($item->start_date >= $start_date && $item->end_date <= $end_date){
                return $item;
            }
        });
    }
}
