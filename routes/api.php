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
    Route::get('/gradebooks/{gradebook}/students/create', 'StudentController@store');
    Route::get('/gradebooks/{gradebook}/comments/create', 'CommentController@store');
});