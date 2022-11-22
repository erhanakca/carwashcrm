<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ModelRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements ModelRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    public function update(int $id, array $data): Model
    {
        $this->model = $this->find($id);
        $this->model->update($data);
        return $this->model;
    }


    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }


    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
}
