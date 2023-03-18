<?php
use \App\Http\Controllers\Api\ItensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::GET('/gerar-token', [ItensController::class, 'gerartoken'])->name('Gerar-Token');


// ITENS
// GET / Itens
// POST / Itens
// PUT / Itens / :id
// PATCH / Itens / :id
// DEKETE / Itens / :id
Route::apiResource('itens', \App\Http\Controllers\Api\ItensController::class);
Route::POST('/itens/nomesearch', [ItensController::class, 'searchName'])->name('search-Nome');
Route::POST('/itens/tiposearch', [ItensController::class, 'searchTipo'])->name('search-Tipo');
Route::POST('/itens/codigosearch', [ItensController::class, 'searchCodigo'])->name('search-Codigo');

Route::POST('/gerar-token', [ItensController::class, 'gerar'])->name('gerar');
