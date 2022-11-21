<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface JobRepositoryInterface
{
    public function all(): Collection;
    public function statusUpdate(int $id, array $data): Model;
    public function jobUpdate(int $id, array $data): Model;
}
