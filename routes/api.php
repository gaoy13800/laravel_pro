<?php


/*
|--------------------------------------------------------------------------
| API Routes by carBase
|--------------------------------------------------------------------------
*/


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('index', 'App\Api\Controllers\IndexController@index');

    $api->group(['namespace' => 'App\Api\Controllers\V1'], function ($api){

        $api->post('guardPush','MainController@guardPush');
        $api->post('pushSingleCharge','MainController@pushSingleCharge');
        $api->get('test', 'TestController@index_test');
        $api->post('parkingReport', 'ReportController@parkingReport');
        $api->post('getSerialData', 'ReportController@getSerialData');

    });
});

