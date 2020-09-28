<?php

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
// });

Auth::routes();

Route::get('/dashboard','DashboardController@index')->name('dashboard')->middleware('CheckAdmin');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{slug?}', 'WebController@index')->name('index');
Route::post('/show', 'WebController@show')->name('show');
Route::post('/store', 'WebController@store')->name('store');


Route::get('/courses/{slug?}', 'CoursesController@index')->name('courses');
Route::post('/showCourses', 'CoursesController@showCourses')->name('showCourses');
Route::post('/vote/{id}', 'CoursesController@vote')->name('vote');

Route::post('/dashboardShow','DashboardController@dashboardShow')->name('dashboardShow');
Route::post('/approveCourse','DashboardController@approveCourse')->name('approveCourse');
Route::post('/disapproveCourse','DashboardController@disapproveCourse')->name('disapproveCourse');
Route::post('/destroyCourse','DashboardController@destroyCourse')->name('destroyCourse');


Route::post('/search','SearchController@search')->name('search');

Route::get('login/{provider}', 'SocialLoginController@redirect')->name('social.login');
Route::get('login/{provider}/callback', 'SocialLoginController@callback');

Route::post('/filtersAll','CoursesController@filtersAll')->name('filtersAll');
Route::post('/sortByVotes','CoursesController@sortByVotes')->name('sortByVotes');
Route::post('/sortByRecent','CoursesController@sortByRecent')->name('sortByRecent');