<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\SurveillantController;
use App\Http\Controllers\DirecteurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\TypeFormationController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\BatimentController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ElementCompetenceController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\CompSemestreController;
use App\Http\Controllers\CompEmploiController;


// 🔹 Routes de base
Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);

// 🔹 Routes principales
Route::apiResource('formateurs', FormateurController::class);
Route::apiResource('administrateurs', AdministrateurController::class);
Route::apiResource('surveillants', SurveillantController::class);
Route::apiResource('directeurs', DirecteurController::class);
Route::apiResource('eleves', EleveController::class);

// 🔹 Formation et niveau
Route::apiResource('type_formations', TypeFormationController::class);
Route::apiResource('niveaux', NiveauController::class);
Route::apiResource('metiers', MetierController::class);
Route::apiResource('departements', DepartementController::class);

// 🔹 Infrastructure
Route::apiResource('batiments', BatimentController::class);
Route::apiResource('salles', SalleController::class);

// 🔹 Compétences et éléments
Route::apiResource('semestres', SemestreController::class);
Route::apiResource('competences', CompetenceController::class);
Route::apiResource('element_competences', ElementCompetenceController::class);
Route::apiResource('integrations', IntegrationController::class);

// 🔹 Emploi du temps et années
Route::apiResource('emplois', EmploiController::class);
Route::apiResource('annees', AnneeController::class);

// 🔹 Tables pivot
Route::apiResource('comp_semestres', CompSemestreController::class);
Route::apiResource('comp_emplois', CompEmploiController::class);
