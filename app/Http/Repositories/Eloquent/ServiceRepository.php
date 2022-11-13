<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\Collection;



class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return Service::all();
    }
}

