<?php

namespace App\Repositories;

use App\Filters\QueryFilter;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepositoryInterface
{

    public function __construct(
        private Model $model
    )
    {}

    public function all(
        ?QueryFilter $filter = null,
        ?string $relations = null,
        ?int $limit = null
    )
    {
        if ($filter !== null) {
            $this->model = $this->model->filter($filter);
        }

        if ($relations !== null) {
            $this->model = $this->model->with($relations);
        }

        if($limit !== null) {
            $this->model = $this->model->paginate($limit);
        } else {
            $this->model = $this->model->get();
        }

        return $this->model;
    }

    public function find(
        int $id,
        string|array $relations = null,
        ?bool $withTrashed = false
    )
    {
        if ($withTrashed) {
            $this->model = $this->model->withTrashed();
        }

        if ($relations !== null) {
            $this->model = $this->model->with($relations);
        }

        return $this->model->find($id);
    }

    public function destroy(int $id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();

        return $data;
    }
}
