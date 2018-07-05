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

// Tickets
Route::get('tickets', 'TicketController@index'); // Get all
Route::get('ticket/{id}', 'TicketController@show'); // Get one
Route::post('ticket', 'TicketController@store'); // Create one
Route::put('ticket', 'TicketController@store'); // Edit one
Route::delete('ticket/{id}', 'TicketController@destroy'); // Delete one

// Chats
Route::get('chats', 'ChatController@index'); // Get all
Route::get('chat/{id}', 'ChatController@show'); // Get one
Route::post('chat', 'ChatController@store'); // Create one
Route::put('chat', 'ChatController@store'); // Edit one
Route::delete('chat/{id}', 'ChatController@destroy'); // Delete one
