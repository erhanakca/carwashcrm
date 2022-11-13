<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    public function all(): Collection;
}
