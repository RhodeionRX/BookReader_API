<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCompositeKey
{
    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->primaryKey as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }
}
