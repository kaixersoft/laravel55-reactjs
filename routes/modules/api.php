<?php

Route::group(['middleware' => ['api'], 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::group([ 'middleware' => ['isadmin'] , 'prefix' => 'admin' ], function () {
        Route::post('/wallet/create', [  'as' => 'admin.wallet.create', 'uses' => 'Admin\MakeWallet' ] );

        Route::post('/wallet/delete', [  'as' => 'admin.wallet.delete', 'uses' => 'Admin\DeleteWallet' ] );
    });

    Route::group([ 'prefix' => 'client' ], function () {
//        Route::get('/wallet/create', [  'as' => 'admin.wallet.create', 'uses' => 'MakeWallet' ] );
    });


});
