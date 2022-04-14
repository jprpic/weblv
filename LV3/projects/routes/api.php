<?php

use App\Http\Controllers\Projects;
use App\Http\Controllers\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    Route::get('/project/{id}/availableUsers', [ProjectUser::class, 'getAvailableUsers']);

    Route::get('project/{id}/members', [ProjectUser::class, 'getMembers']);

    Route::get('projects', [Projects::class, 'getProjects']);
});
