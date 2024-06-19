<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function destroy(Model $model);
}
