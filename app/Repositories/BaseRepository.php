<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected Model $model
    ) {}

    public function find(int $id) : ?array
    {
        return $this->model->findOrFail($id)?->toArray();
    }

    public function findAll() : ?array
    {
        return $this->model->all()->toArray();
    }

    public function destroy(int $id) : ?stdClass
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return (object) $model->toArray();
    }
}
