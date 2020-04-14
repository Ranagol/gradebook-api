<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//----------------------------------------------------------------


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');



Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::resource('/gradebooks', 'GradebookController');
    Route::resource('/professors', 'ProfessorController');
    Route::resource('/pictures', 'PictureController');
    Route::resource('/comments', 'CommentController');
    Route::post('/gradebooks/{gradebook}/students/create', 'StudentController@store');
    Route::post('/gradebooks/{gradebook}/comments/create', 'CommentController@store');
    Route::get('/gradebooks/available', 'GradebookController@availableGradebooks');
    Route::get('/available-professors', 'ProfessorController@availableProfessors');
    Route::get('/my-gradebook', 'GradebookController@mygradebook');
});

