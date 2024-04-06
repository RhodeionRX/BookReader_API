<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function find(int $id);
    public function findAll();
    public function destroy(int $id);
}
