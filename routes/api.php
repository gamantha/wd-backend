<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1', 'middleware' => 'cognito-auth'], function () use ($router) {
    $router->get('/checkToken', [
        'as' => 'checkToken',
        'uses' => 'TokenController@checkToken'
    ]);

    $router->group(['prefix' => '/report_templates'], function () use ($router) {
        $router->patch('/{id}', [
            'as' => 'report_templates',
            'uses' => 'ReportTemplateController@update'
        ]);

        $router->delete('/{id}', [
            'as' => 'report_templates',
            'uses' => 'ReportTemplateController@delete'
        ]);

        $router->post('/', [
            'as' => 'report_templates',
            'uses' => 'ReportTemplateController@create'
        ]);

        $router->get('/', [
            'as' => 'report_templates',
            'uses' => 'ReportTemplateController@get'
        ]);

        $router->get('/{id}', [
            'as' => 'report_templates',
            'uses' => 'ReportTemplateController@find'
        ]);
    });

    //Endpoint for Report CRUD
    $router->group(['prefix' => '/reports'], function () use ($router) {
        $router->get('/', [
            'as' => 'report',
            'uses' => 'ReportController@get'
        ]);

        $router->post('/', [
            'as' => 'report',
            'uses' => 'ReportController@create'
        ]);

        $router->get('/{id}', [
            'as' => 'report',
            'uses' => 'ReportController@find'
        ]);

        $router->delete('/{id}', [
            'as' => 'report',
            'uses' => 'ReportController@delete'
        ]);

        $router->patch('/{id}', [
            'as' => 'report',
            'uses' => 'ReportController@update'
        ]);
    });

    $router->group(['prefix' => '/indicators'], function () use ($router) {
        $router->get('/', [
            'as' => 'indicators',
            'uses' => 'IndicatorController@get'
        ]);
        $router->get('/{id}', [
            'as' => 'indicators',
            'uses' => 'IndicatorController@find'
        ]);
        $router->post('/', [
            'as' => 'indicators',
            'uses' => 'IndicatorController@create'
        ]);
        $router->patch('/{id}', [
            'as' => 'indicators',
            'uses' => 'IndicatorController@update'
        ]);

        $router->delete('/{id}', [
            'as' => 'indicators',
            'uses' => 'IndicatorController@delete'
        ]);
    });

    $router->group(['prefix' => '/morbidity'], function () use ($router) {
        $router->get('/', [
            'as' => 'morbidity',
            'uses' => 'MorbidityController@get'
        ]);
        $router->get('/{id}', [
            'as' => 'morbidity',
            'uses' => 'MorbidityController@find'
        ]);
        $router->post('/', [
            'as' => 'morbidity',
            'uses' => 'MorbidityController@create'
        ]);
        $router->patch('/{id}', [
            'as' => 'morbidity',
            'uses' => 'MorbidityController@update'
        ]);

        $router->delete('/{id}', [
            'as' => 'morbidity',
            'uses' => 'MorbidityController@delete'
        ]);
    });
});
