<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VacancyController;
use App\Http\Controllers\Api\VacancyResponseController;

Route::resource('vacancies', VacancyController::class);

Route::get('vacancies/{id}/responses', [VacancyResponseController::class, 'responses']);
Route::post('vacancies/{id}/response', [VacancyResponseController::class, 'response']);
