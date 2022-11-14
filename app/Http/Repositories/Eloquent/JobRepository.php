<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\JobRepositoryInterface;
use App\Models\Job;
use Illuminate\Support\Collection;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{

    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return Job::with('service', 'customer', 'user', 'vehicleType')->get();
    }
}
