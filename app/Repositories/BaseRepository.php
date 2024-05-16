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
        $data = $this->model;

        if ($filter !== null) {
            $data = $data->filter($filter);
        }

        if ($relations !== null) {
            $data = $data->with($relations);
        }

        if($limit !== null) {
            $data = $data->paginate($limit);
        } else {
            $data = $data->get();
        }

        return $data;
    }

    public function find(
        int $id,
        string|array $relations = null,
        ?bool $withTrashed = false
    )
    {
        $data = $this->model;

        if ($withTrashed) {
            $data = $data->withTrashed();
        }

        if ($relations !== null) {
            $data = $data->with($relations);
        }

        return $data->find($id);
    }

    public function destroy(int $id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();

        return $data;
    }
}
