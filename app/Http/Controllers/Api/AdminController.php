<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resume\ResumeRequest;
use App\Http\Requests\Api\Vacancy\VacancyRequest;
use App\Services\AdminService;
use App\Services\ResumeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @var AdminService
     */
    protected AdminService $adminService;

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->middleware('role:user');

        $this->adminService = $adminService;
    }

    /**
     * Get all vacancies.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function vacancies(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->adminService->vacancies($request->all()));
    }

    /**
     * Get resumes.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resumes(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->adminService->resumes($request->all()));
    }
}
