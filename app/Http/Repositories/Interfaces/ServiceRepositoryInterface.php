<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ServiceRepositoryInterface
{
    public function all(): Collection;
}
