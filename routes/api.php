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


/*
+--------+-----------+--------------------------------------------+--------------------+----------------------------------------------------------+----------------+
| Domain | Method    | URI                                        | Name               | Action                                                   | Middleware     |
+--------+-----------+--------------------------------------------+--------------------+----------------------------------------------------------+----------------+
|        | GET|HEAD  | /                                          |                    | Closure                                                  | web            |
|        | GET|HEAD  | api/gradebooks                             | gradebooks.index   | App\Http\Controllers\GradebookController@index           | api,jwt.verify |
|        | POST      | api/gradebooks                             | gradebooks.store   | App\Http\Controllers\GradebookController@store           | api,jwt.verify |
|        | GET|HEAD  | api/gradebooks/create                      | gradebooks.create  | App\Http\Controllers\GradebookController@create          | api,jwt.verify |
|        | GET|HEAD  | api/gradebooks/{gradebook}                 | gradebooks.show    | App\Http\Controllers\GradebookController@show            | api,jwt.verify |
|        | PUT|PATCH | api/gradebooks/{gradebook}                 | gradebooks.update  | App\Http\Controllers\GradebookController@update          | api,jwt.verify |
|        | DELETE    | api/gradebooks/{gradebook}                 | gradebooks.destroy | App\Http\Controllers\GradebookController@destroy         | api,jwt.verify |
|        | GET|HEAD  | api/gradebooks/{gradebook}/comments/create |                    | App\Http\Controllers\CommentController@store             | api,jwt.verify |
|        | GET|HEAD  | api/gradebooks/{gradebook}/edit            | gradebooks.edit    | App\Http\Controllers\GradebookController@edit            | api,jwt.verify |
|        | GET|HEAD  | api/gradebooks/{gradebook}/students/create |                    | App\Http\Controllers\StudentController@store             | api,jwt.verify |
|        | POST      | api/login                                  |                    | App\Http\Controllers\UserController@authenticate         | api            |
|        | GET|HEAD  | api/professors                             | professors.index   | App\Http\Controllers\ProfessorController@index           | api,jwt.verify |
|        | POST      | api/professors                             | professors.store   | App\Http\Controllers\ProfessorController@store           | api,jwt.verify |
|        | GET|HEAD  | api/professors/create                      | professors.create  | App\Http\Controllers\ProfessorController@create          | api,jwt.verify |
|        | GET|HEAD  | api/professors/{professor}                 | professors.show    | App\Http\Controllers\ProfessorController@show            | api,jwt.verify |
|        | PUT|PATCH | api/professors/{professor}                 | professors.update  | App\Http\Controllers\ProfessorController@update          | api,jwt.verify |
|        | DELETE    | api/professors/{professor}                 | professors.destroy | App\Http\Controllers\ProfessorController@destroy         | api,jwt.verify |
|        | GET|HEAD  | api/professors/{professor}/edit            | professors.edit    | App\Http\Controllers\ProfessorController@edit            | api,jwt.verify |
|        | POST      | api/register                               |                    | App\Http\Controllers\UserController@register             | api            |
|        | GET|HEAD  | api/user                                   |                    | App\Http\Controllers\UserController@getAuthenticatedUser | api,jwt.verify |
+--------+-----------+--------------------------------------------+--------------------+----------------------------------------------------------+----------------+
*/