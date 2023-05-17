<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResumeController;
use App\Http\Controllers\Api\ResumePortfolioController;

Route::resource('resumes', ResumeController::class);
Route::resource('resumes/{resume_id}/portfolios', ResumePortfolioController::class);

Route::get('resumes/{id}/vacancies', [ResumeController::class, 'vacancies']);
