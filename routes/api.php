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

    $router->patch('/report_templates/{id}', [
        'as' => 'report_templates',
        'uses' => 'ReportTemplateController@update'
    ]);

    $router->delete('/report_templates/{id}', [
        'as' => 'report_templates',
        'uses' => 'ReportTemplateController@delete'
    ]);

    $router->post('/report_templates', [
        'as' => 'report_templates',
        'uses' => 'ReportTemplateController@create'
    ]);

    $router->get('/report_templates', [
        'as' => 'report_templates',
        'uses' => 'ReportTemplateController@get'
    ]);

    $router->get('/report_templates/{id}', [
        'as' => 'report_templates',
        'uses' => 'ReportTemplateController@find'
    ]);

    //Endpoint for Report CRUD
    $router->get('/report', [
        'as' => 'report',
        'uses' => 'ReportController@get'
    ]);

    $router->post('/report', [
        'as' => 'report',
        'uses' => 'ReportController@create'
    ]);

    $router->get('/report/{id}', [
        'as' => 'report',
        'uses' => 'ReportController@find'
    ]);

    $router->delete('/report/{id}', [
        'as' => 'report',
        'uses' => 'ReportController@delete'
    ]);

    $router->patch('/report/{id}', [
        'as' => 'report',
        'uses' => 'ReportController@update'
    ]);
});
