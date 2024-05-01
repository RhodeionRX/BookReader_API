<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], (array)$value);
            }
        }
    }

    protected function fields(): array
    {
        return array_filter(
          array_map('trim', $this->request->all())
        );
    }
}
