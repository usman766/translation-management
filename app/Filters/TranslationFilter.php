<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TranslationFilter
{
    /**
     * Apply the filters to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function apply(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['tag'] ?? null, fn($query, $tag) => $query->where('tag', $tag))
            ->when($filters['key'] ?? null, fn($query, $key) => $query->where('key', 'LIKE', "%$key%"))
            ->when($filters['content'] ?? null, fn($query, $content) => $query->where('value', 'LIKE', "%$content%"));
    }
}
