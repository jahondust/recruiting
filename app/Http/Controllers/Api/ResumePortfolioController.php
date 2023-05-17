<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resume\ResumePortfolioRequest;
use App\Services\ResumePortfolioService;

class ResumePortfolioController extends Controller
{
    /**
     * @var ResumePortfolioService
     */
    protected ResumePortfolioService $resumePortfolioService;

    /**
     * @param ResumePortfolioService $resumePortfolioService
     */
    public function __construct(ResumePortfolioService $resumePortfolioService)
    {
        $this->middleware('role:user');

        $this->resumePortfolioService = $resumePortfolioService;
    }

    /**
     * Create vacancy.
     *
     * @param int $resume_id
     * @param ResumePortfolioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(int $resume_id, ResumePortfolioRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumePortfolioService->store($resume_id, $request->validated()));
    }

    /**
     * Update vacancy.
     *
     * @param int $resume_id
     * @param int $id
     * @param ResumePortfolioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $resume_id, int $id, ResumePortfolioRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumePortfolioService->update($resume_id, $id, $request->validated()));
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->resumePortfolioService->destroy($id));
    }
}
