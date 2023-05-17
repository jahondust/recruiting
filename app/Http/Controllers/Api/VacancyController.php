<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vacancy\VacancyRequest;
use App\Models\Vacancy;
use App\Services\VacancyService;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * @var VacancyService
     */
    protected VacancyService $vacancyService;

    /**
     * @param VacancyService $vacancyService
     */
    public function __construct(VacancyService $vacancyService)
    {
        $this->middleware('role:organization', ['except' => ['index', 'show']]);

        $this->vacancyService = $vacancyService;
    }

    /**
     * Get all vacancies.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->index($request->all()));
    }

    /**
     * Get vacancy detail.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->show($id));
    }

    /**
     * Create vacancy.
     *
     * @param VacancyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VacancyRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->store($request->validated()));
    }

    /**
     * Update vacancy.
     *
     * @param int $id
     * @param VacancyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, VacancyRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->update($id, $request->validated()));
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->destroy($id));
    }
}
