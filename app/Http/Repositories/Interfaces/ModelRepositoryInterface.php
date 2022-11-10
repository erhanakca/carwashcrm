<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ModelRepositoryInterface
{
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): bool;
    public function find(int $id): Model;
}
