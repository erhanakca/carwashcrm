<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface JobRepositoryInterface
{
    public function all(): Collection;
}
