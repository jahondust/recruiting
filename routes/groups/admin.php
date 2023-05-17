<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;

Route::get('vacancies', [AdminController::class, 'vacancies']);
Route::get('resumes', [AdminController::class, 'resumes']);
