<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Client\Http\Controllers'], function()
{
    Route::get('/', 'ClientController@index');
});
