<?php

use App\Http\Controllers\AnneeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name("Home");

Route::get('/inscriptions', function () {
    return view('inscription');
})->name("inscription");
Route::get("/student", [StudentController::class, "index"])->name("Student");
Route::get("/student/create", [StudentController::class, "create"])->name("Student.create");
Route::post("/student/create", [StudentController::class, "store"])->name("Student.ajouter");
Route::get("/student-edit/{id}", [StudentController::class, "edit"]);
Route::put('/student-update/{id}', [StudentController::class, 'update']);
Route::delete("/student/{student}", [StudentController::class, "destroy"])->name("Student.delete");

Route::get('/', [AnneeController::class, 'index'])->name('Home');
Route::post('/year/add', [AnneeController::class, 'store'])->name('ajout-annee');
Route::get('/year/change-active/{id}', [AnneeController::class, 'ActiveAnnee'])->name('active-annee');


Route::post('/registration', [InscriptionController::class, 'newRegister'])->name('register');
Route::get('/list-registration', [InscriptionController::class, 'index'])->name('index-register');
Route::get('/get-classe', [InscriptionController::class, 'getAllClasse'])->name('get-classe-annee');
Route::get('/year-regist-liste-json', [InscriptionController::class, 'getAnneeInscriJson'])->name('annee-inscri-liste-json');
