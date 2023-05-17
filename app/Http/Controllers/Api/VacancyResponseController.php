<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vacancy\VacancyRequest;
use App\Services\VacancyService;
use Illuminate\Http\Request;

class VacancyResponseController extends Controller
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
        $this->middleware('role:user');

        $this->vacancyService = $vacancyService;
    }

    /**
     * Response vacancy.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->response($id, $request->all()));
    }

    /**
     * Response vacancy.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function responses(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse($this->vacancyService->responses($id, $request->all()));
    }
}
