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

/****Membership types****/
$router->post('membership/type/store', [
    'as' => 'membership_type_store', 'uses' => 'MembershipTypeController@store'
]);

$router->get('membership/type/get', [
    'as' => 'membership_type_get', 'uses' => 'MembershipTypeController@get'
]);


$router->post('organization/store', [
    'as' => 'organization', 'uses' => 'UserController@showProfile'
]);