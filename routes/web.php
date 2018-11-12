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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);


Route::get('{provider}/auth', [
    'uses' => 'SocialController@auth',
    'as' => 'social.auth'
]);
Route::get('{provider}/redirect', [
    'uses' => 'SocialController@auth_callback',
    'as' => 'social.callback'
]);

Route::get('discussion/{slug}', [
    'uses' => 'DiscussionsController@show',
    'as' => 'discussion'
]);


Route::get('channel-d/{slug}', [
    'uses' => 'ForumsController@channelD',
    'as' => 'channel_d'
]);
// we used this separately from auth(middleware) and ChannelsController->Construct admin middleware


Route::group(['middleware' => 'auth'], function (){

    Route::resource('channels', 'ChannelsController');

    Route::get('discussions/create', [
        'uses' => 'DiscussionsController@create',
        'as' => 'discussion.create'
    ]);
    Route::post('discussions/store', [
        'uses' => 'DiscussionsController@store',
        'as' => 'discussion.store'
    ]);

    Route::get('discussions/edit/{slug}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);
    Route::post('discussions/update/{id}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussion.update'
    ]);

    Route::post('discussion/{id}/reply', [
        'uses' => 'RepliesController@reply',
        'as' => 'discussion.reply'
    ]);

    Route::get('reply/like/{id}', [
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('reply/unlike/{id}', [
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    Route::get('discussion/watch/{id}', [
        'uses' => 'WatchersController@watch',
        'as' => 'Dwatch'
    ]);

    Route::get('discussion/unwatch/{id}', [
        'uses' => 'WatchersController@unwatch',
        'as' => 'Dunwatch'
    ]);


    Route::get('discussion/{did}/{rid}', [
        'uses' => 'RepliesController@best_ans',
        'as' => 'discussion.best.ans'
    ]);

    Route::get('reply/edit/{id}', [
        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'
    ]);
    Route::post('reply/update/{id}', [
        'uses' => 'RepliesController@update',
        'as' => 'reply.update'
    ]);


});














