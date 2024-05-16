<?php

namespace App\Repositories;

interface IBaseRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function destroy(int $id);
}
