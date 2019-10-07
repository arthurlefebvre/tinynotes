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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('redirect', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider');

Route::get('callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback');

Route::get('conversation', 'ConversationController@index')
    ->name('conversation.index');

Route::post('conversation/create', 'ConversationController@create')
    ->name('conversation.create');

Route::get('conversation/{id}', 'ConversationController@findConversationById')
    ->name('conversation.findConversationById');

Route::get('conversations', 'ConversationController@list')
    ->name('conversation.list');

Route::post('conversation/findUserByEmail', 'ConversationController@findUserByEmail')
    ->name('conversation.findUserByEmail');

Route::post('conversation/{id}/addMessage', 'ConversationController@addMessage')
    ->name('conversation.addMessage');

Route::post('conversation/updateMessage/{message_id}', 'ConversationController@updateMessage')
    ->name('conversation.updateMessage');

Route::post('conversation/deleteMessage', 'ConversationController@deleteMessage')
    ->name('conversation.deleteMessage');
