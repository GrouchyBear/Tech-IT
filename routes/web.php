<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// new ticket, store and create //
Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');


// Show users tickets //
Route::get('user_tickets', 'TicketsController@userTickets');


// Show detailed view of ticket & post comments//
Route::get('tickets/{ticket_id}', 'TicketsController@show');
Route::post('comment', 'TicketsController@postComment');
