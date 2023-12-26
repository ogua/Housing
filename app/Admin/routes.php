<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.as'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('housing', Admin\HouseController::class);

    $router->resource('housedetails', Admin\HousedetailController::class);

    $router->get('bot-run', 'Admin\HouseController@botrun');

    $router->get('run-bot', 'Admin\HouseController@runbot');

    $router->get('generate-report', 'Admin\HouseController@generatereport');

    $router->get('generated-report/{fromdate}/{todate}', 'Admin\HouseController@generatedreport');

});
