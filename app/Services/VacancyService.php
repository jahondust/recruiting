<?php

namespace App\Services;

use App\Models\Vacancy;

class VacancyService
{
    /**
     * Get all vacancies.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(array $filters): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Vacancy::query();

        $query->with(['position', 'author']);

        if (isset($filters['positions'])) {
            $query->whereIn('position_id', $filters['positions']);
        }

        if (isset($filters['skills'])) {
            $query->whereHas('skills', function($q) use ($filters) {
                $q->whereIn('id', $filters['skills']);
            });
        }

        $perPage = $filters['per_page'] ?? config('api.pagination_per_page');

        return $query->paginate($perPage);
    }

    /**
     * Get vacancy detail.
     *
     * @param int $id
     * @return object
     */
    public function show(int $id): object
    {
        $vacancy = Vacancy::with(['position', 'skills', 'author'])->findOrFail($id)->append('views_count');

        //update views count
        $vacancy->views()->attach(auth()->id());

        return $vacancy;
    }

    /**
     * Create vacancy.
     *
     * @param array $data
     * @return Vacancy
     */
    public function store(array $data): Vacancy
    {
        $vacancy = Vacancy::create($data);

        $vacancy->skills()->sync($data['skills']);

        $vacancy->skills = $vacancy->skills()->get();

        return $vacancy;
    }

    /**
     * Update vacancy.
     *
     * @param int $id
     * @param array $data
     * @return Vacancy
     */
    public function update(int $id, array $data): Vacancy
    {
        $vacancy = Vacancy::findOrFail($id);

        if (!$vacancy->checkOwner()) {
            abort(401, 'permission denied');
        }

        $vacancy->update($data);

        $vacancy->skills()->sync($data['skills']);

        $vacancy->skills = $vacancy->skills()->get();

        return $vacancy;
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $vacancy = Vacancy::findOrFail($id);

        if (!$vacancy->checkOwner()) {
            abort(401, 'permission denied');
        }

        return $vacancy->delete();
    }

    /**
     * Response vacancy.
     *
     * @param int $id
     * @param array $data
     * @return Vacancy
     */
    public function response(int $id, array $data): Vacancy
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->responses()->syncWithoutDetaching($data['resume_id']);

        return $vacancy;
    }

    /**
     * Response vacancy.
     *
     * @param int $id
     * @param array $data
     * @return object
     */
    public function responses(int $id, array $data): object
    {
        $vacancy = Vacancy::findOrFail($id);

        return $vacancy->responses()->get();
    }
}
