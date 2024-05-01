<?php

namespace App\Filters;

final class BookFilter extends QueryFilter
{
    public function title(string $title = null)
    {
        return $this->builder->whereHas('details', function ($query) use ($title) {
            return $query->where('title', 'LIKE', "%$title%");
        });
    }

    public function language(string $language = null)
    {
        return $this->builder->whereHas('details', function ($query) use ($language) {
            return $query->where('language', $language);
        });
    }
}
