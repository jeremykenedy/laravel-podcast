<?php

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

// Auth Routes
Auth::routes();

// APP Routes Below
Route::get('/', 'PodcastsController@index');
Route::get('/podcast', 'PodcastsController@index');
Route::get('/podcasts/player', 'PodcastsController@index');
Route::get('/podcasts/manage', 'PodcastsController@manage');
Route::get('/podcasts/favorites', 'PodcastsController@favorites');
Route::get('/podcasts/settings', 'PodcastsController@settings');

Route::get('/podcasts/auto-update', function () {
	$exitCode = Artisan::call('updatePodcastItems');
	if ($exitCode == 0) {
		return redirect('podcasts/player');
	}
});

Route::resource('/podcasts', 'PodcastsController');

Route::get('/podcast/search', 'PodcastItemsController@search');
Route::post('/podcast/mark-as-read', 'PodcastItemsController@markAsRead');
Route::post('/podcast/mark-as-favorite', 'PodcastItemsController@markAsFavorite');
Route::post('/podcast/mark-all-prev-read', 'PodcastItemsController@markAllPrevAsRead');
