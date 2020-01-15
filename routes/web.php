<?php

use Illuminate\Support\Facades\Redirect;


// Authentication Routes
Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function() {
        return Redirect::to('/home');
    });
    Route::get('/exchange', ['as'   => 'exchange.show', 'uses'   => 'OrdersController@exchangeShow']);
    Route::get('/home', ['as'   => 'home', 'uses'   => 'UserController@index']);

    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);
    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as'       => 'authenticated.activation-resend', 'uses'       => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as'         => 'exceeded', 'uses'         => 'Auth\ActivateController@exceeded']);
});

Route::group(['middleware' => ['auth', 'activated', '2fa']], function () {
    Route::get('/trades',        ['as' => 'trades.historyShow',        'uses' => 'TradesController@historyShow']);
    Route::get('/orders',        ['as' => 'orders.historyShow',        'uses' => 'OrdersController@historyShow']);
    Route::get('/funds',         ['as' => 'accounts.fundsShow',        'uses' => 'AccountsController@fundsShow']);
    Route::get('/transactions',  ['as' => 'accounts.transactions',     'uses' => 'AccountsController@transactions']);
    Route::get('/wallets',       ['as' => 'accounts.wallets',          'uses' => 'AccountsController@wallets']);
    Route::get('/profile',       ['as' => 'profile',                   'uses' => 'UserController@profile']);

    Route::group(['prefix' => 'api'], function () {
        Route::get('/order', ['as' => 'api.order', 'uses' => 'LiquidityClientController@placeOrder']);
        Route::get('/openBuyOrders', ['as' => 'api.openBuyOrders', 'uses' => 'LiquidityClientController@openBuyOrders']);
        Route::get('/openSellOrders', ['as' => 'api.openSellOrders', 'uses' => 'LiquidityClientController@openSellOrders']);
        Route::get('/myTrades', ['as' => 'api.myTrades', 'uses' => 'LiquidityClientController@myTrades']);
        Route::get('/openOrders', ['as' => 'api.openOrders', 'uses' => 'LiquidityClientController@openOrders']);
        Route::get('/ordersHistory', ['as' => 'api.ordersHistory', 'uses' => 'LiquidityClientController@ordersHistory']);
    });


    Route::group(['prefix' => 'schedule'], function() {
        Route::get('/start', 'LiquidityClientController@scheduleStart');
        Route::get('/stop', 'LiquidityClientController@scheduleStop');
    });

    Route::group(['prefix' => 'apikeys'], function () {
        Route::get('/', 'GunthyAPIController@show');
        Route::post('/generate', 'GunthyAPIController@generate');
        Route::post('/deleteApikey', 'GunthyAPIController@deleteApikey');
    });

});

Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout',        ['uses' => 'Auth\LoginController@logout']);

    Route::group(['prefix' => 'google2fa'], function () {
        Route::get('/', ['as' => 'google2fa.show', 'uses' => 'Google2faController@index']);
        Route::post('/enable', 'Google2faController@showEnableTwoFactor');
        Route::post('/confirmEnable', 'Google2faController@enableTwoFactor');
        Route::get('/disable', 'Google2faController@disableTwoFactor')->middleware('2fa');
        Route::get('/validate', 'Google2faController@getValidateToken');
        Route::post('/validate', ['middleware' => 'throttle:5', 'uses' => 'Google2faController@postValidateToken']);
    });
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/ticker', ['as' => 'api.ticker', 'uses' => 'LiquidityClientController@ticker']);
    Route::get('/buyOrders', ['as' => 'api.buyOrders', 'uses' => 'LiquidityClientController@buyOrders']);
    Route::get('/sellOrders', ['as' => 'api.sellOrders', 'uses' => 'LiquidityClientController@sellOrders']);
    Route::get('/trades', ['as' => 'api.trades', 'uses' => 'LiquidityClientController@trades']);
    Route::get('/siteWallets', ['as' => 'api.siteWallets', 'uses' => 'LiquidityClientController@siteWallets']);
    Route::get('/24hrVolumns', ['as' => 'api.24hrVolumns', 'uses' => 'LiquidityClientController@get24hrVolumns']);
});


Route::group(['prefix' => 'trading_view'], function () {
    Route::get('/config', ['uses' => 'TradingViewController@config']);
    Route::get('/symbol_info', ['uses' => 'TradingViewController@symbol_info']);
    Route::get('/symbols', ['uses' => 'TradingViewController@symbols']);
    Route::get('/search', ['uses' => 'TradingViewController@search']);
    Route::get('/history', ['uses' => 'TradingViewController@history']);
    Route::get('/marks', ['uses' => 'TradingViewController@marks']);
    Route::get('/marks', ['uses' => 'TradingViewController@marks']);
    Route::get('/timescale_marks', ['uses' => 'TradingViewController@timescale_marks']);
    Route::get('/time', ['uses' => 'TradingViewController@time']);
    Route::get('/quotes', ['uses' => 'TradingViewController@quotes']);

    Route::get('/serverTime', 'TradingViewController@serverTime');
    Route::get('/exchangeInfo', 'TradingViewController@exchangeInfo');
    Route::get('/klines', 'TradingViewController@klines');
});


Route::group(['middleware' => ['web']], function () {
    Route::get('/trading_save/1.1/charts', 'TradingViewController@charts');
    Route::get('/trading_save/1.1/study_templates', 'TradingViewController@charts');
});