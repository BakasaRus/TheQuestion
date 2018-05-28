<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/logout', function (Request $request) {
    $request->user()->token()->revoke();
    return ['message' => 'Success!'];
});

Route::get('/questions', 'QuestionsController@index');
Route::post('/questions', 'QuestionsController@store');
Route::get('/questions/{question}', 'QuestionsController@show');
Route::post('/questions/{question}/answers', 'AnswersController@store');

Route::get('/users/{user}', 'UsersController@show');
Route::patch('/users/{user}/deactivate', 'UsersController@deactivate');

Route::get('/themes', 'ThemesController@index');

Route::get('/{model}/{id}/comments', 'CommentsController@show');
Route::post('/{model}/{id}/comments', 'CommentsController@store');