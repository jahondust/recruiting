<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\Vacancy;

class ResumeService
{
    /**
     * Get all vacancies.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(array $filters): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Resume::query();

        $query->with(['positions', 'author']);

        if (isset($filters['positions'])) {
            $query->whereHas('positions', function($q) use ($filters) {
                $q->whereIn('id', $filters['positions']);
            });
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
        $resume = Resume::with(['positions', 'skills', 'author', 'portfolios', 'languages'])->findOrFail($id)->append('views_count');

        //update views count
        $resume->views()->attach(auth()->id());

        return $resume;
    }

    /**
     * Create vacancy.
     *
     * @param array $data
     * @return Resume
     */
    public function store(array $data): Resume
    {
        $data['avatar'] = $this->upload($data['avatar'], 'avatars');

        $resume = Resume::create($data);

        $resume->positions()->sync($data['positions']);
        $resume->skills()->sync($data['skills']);
        $resume->languages()->sync($data['languages']);

        $resume->skills = $resume->skills()->get();
        $resume->positions = $resume->positions()->get();

        return $resume;
    }

    /**
     * Update vacancy.
     *
     * @param int $id
     * @param array $data
     * @return Resume
     */
    public function update(int $id, array $data): Resume
    {
        $resume = Resume::findOrFail($id);

        if (!$resume->checkOwner()) {
            abort(401, 'permission denied');
        }

        $data['avatar'] = $this->upload($data['avatar'], 'avatars');

        $resume->update($data);

        $resume->positions()->sync($data['positions']);
        $resume->skills()->sync($data['skills']);
        $resume->languages()->sync($data['languages']);

        $resume->skills = $resume->skills()->get();

        return $resume;
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $resume = Resume::findOrFail($id);

        if (!$resume->checkOwner()) {
            abort(401, 'permission denied');
        }

        return $resume->delete();
    }

    /**
     * Upload file.
     *
     * @param $file
     * @param $path
     * @return string
     */
    public function upload($file, $path): string
    {
        return $file->store($path);
    }

    /**
     * Get vacancy detail.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function vacancies(int $id): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $resume = Resume::findOrFail($id);

        $query = Vacancy::with(['author', 'position']);
        $query->whereIn('position_id', $resume->positions()->pluck('id')->toArray());

        $perPage = $filters['per_page'] ?? config('api.pagination_per_page');

        return $query->paginate($perPage);
    }
}
