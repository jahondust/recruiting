<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resume\ResumeRequest;
use App\Http\Requests\Api\Vacancy\VacancyRequest;
use App\Services\ResumeService;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * @var ResumeService
     */
    protected ResumeService $resumeService;

    /**
     * @param ResumeService $resumeService
     */
    public function __construct(ResumeService $resumeService)
    {
        $this->middleware('role:user', ['except' => ['index', 'show']]);

        $this->resumeService = $resumeService;
    }

    /**
     * Get all vacancies.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumeService->index($request->all()));
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
        return $this->sendResponse($this->resumeService->show($id));
    }

    /**
     * Create vacancy.
     *
     * @param ResumeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ResumeRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumeService->store($request->validated()));
    }

    /**
     * Update vacancy.
     *
     * @param int $id
     * @param ResumeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, ResumeRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumeService->update($id, $request->validated()));
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumeService->destroy($id));
    }

    /**
     * Get vacancies.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function vacancies(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumeService->vacancies($id));
    }
}
