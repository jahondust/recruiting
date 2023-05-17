<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AdminService
{
    /**
     * Get all vacancies.
     *
     * @param array $filters
     * @return array
     */
    public function vacancies(array $filters): array
    {
        $query = DB::select("
            SELECT v.*, COUNT(vr.id) AS responses_count FROM vacancy_responses AS vr
            RIGHT JOIN vacancies AS v ON v.id = vr.vacancy_id
            GROUP BY v.id
        ");

        return $query;
    }

    /**
     * Get resumes.
     *
     * @param array $filters
     * @return array
     */
    public function resumes(array $filters): array
    {
        $query = DB::select("
            SELECT r.*, COUNT(vr.id) AS responses_count FROM vacancy_responses AS vr
            RIGHT JOIN resumes AS r ON r.id = vr.resume_id
            WHERE r.created_at between date_sub(now(),INTERVAL 1 WEEK) and now()
            GROUP BY r.id
        ");

        return $query;
    }
}
