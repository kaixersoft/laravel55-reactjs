<?php

Route::group(['middleware' => ['api'], 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::group([ 'middleware' => ['isadmin'] , 'prefix' => 'admin' ], function () {
        Route::post('/wallet/create', [  'as' => 'admin.wallet.create', 'uses' => 'Admin\MakeWallet' ] );
        Route::post('/wallet/delete', [  'as' => 'admin.wallet.delete', 'uses' => 'Admin\DeleteWallet' ] );
        Route::get('/wallet/user', [  'as' => 'admin.wallet.user', 'uses' => 'Admin\UserWallet' ] );
    });

    Route::group([ 'prefix' => 'user' ], function () {
        Route::post('/credit', [  'as' => 'user.wallet.credit', 'uses' => 'Client\Credit' ] );
        Route::post('/debit', [  'as' => 'user.wallet.debit', 'uses' => 'Client\Debit' ] );
        Route::get('/wallet', [  'as' => 'user.wallet', 'uses' => 'Client\GetWallet' ] );
    });


});
