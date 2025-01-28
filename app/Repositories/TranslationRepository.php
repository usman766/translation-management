<?php

namespace App\Repositories;

use App\Filters\TranslationFilter;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;

class TranslationRepository
{

    /**
     * Paginate translations for scalability.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(array $filters, int $perPage = 50)
    {
        $query = Translation::query();
        return TranslationFilter::apply($query, $filters)->paginate($perPage);
    }

    /**
     * Create a new translation record.
     *
     * @param array $data
     * @return Translation
     */
    public function create(array $data): Translation
    {
        return Translation::create($data);
    }

    /**
     * Retrieve a translation by its ID.
     *
     * @param int $id
     * @return Translation|null
     */
    public function findById(int $id): ?Translation
    {
        return Translation::find($id);
    }

    /**
     * Update a translation record.
     *
     * @param Translation $translation
     * @param array $data
     * @return bool
     */
    public function update(Translation $translation, array $data): bool
    {
        return $translation->update($data);
    }

    /**
     * Delete a translation record.
     *
     * @param Translation $translation
     * @return bool|null
     */
    public function delete(Translation $translation): ?bool
    {
        return $translation->delete();
    }

    /**
     * Export translations.
     *
     * @param array $filters
     * @return mixed
     */
    public function export(array $filters)
    {
        $query = Translation::query();
        return TranslationFilter::apply($query, $filters)->get();
    }
}
