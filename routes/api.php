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

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@getById');
Route::post('/users/register', 'UserController@register');
Route::post('/users/login', 'UserController@login');

Route::apiResource('/pets', 'PetController');
Route::get('/pets/{id}/comments', 'PetController@getComments');
Route::apiResource('/petAds', 'PetAdController');
Route::get('/petAds/{id}/comments', 'PetAdController@getComments');
Route::get('/lostPets', 'PetAdController@getLostPets');
Route::get('/adoptingPets', 'PetAdController@getAdoptingPets');

Route::apiResource('/petComments', 'PetCommentController');
Route::apiResource('/petAdComments', 'PetAdCommentController');