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

$router->post('membership/type/update', [
    'as' => 'membership_type_update', 'uses' => 'MembershipTypeController@update'
]);

$router->get('membership/type/get', [
    'as' => 'membership_type_get', 'uses' => 'MembershipTypeController@get'
]);

/**Organization****/
$router->post('organization/store', [
    'as' => 'organization', 'uses' => 'OrganizationController@store'
]);

$router->post('organization/update', [
    'as' => 'organization_update', 'uses' => 'OrganizationController@update'
]);

$router->get('organization/get', [
    'as' => 'organization_get', 'uses' => 'OrganizationController@get'
]);


/****User****/
$router->post('user/store', [
    'as' => 'user_store', 'uses' => 'UserController@store'
]);

$router->post('user/update', [
    'as' => 'user_update', 'uses' => 'UserController@update'
]);

$router->get('user/get', [
    'as' => 'user_get', 'uses' => 'UserController@get'
]);


/*******File***********/
$router->post("file/type/store",[
    'as' => 'file_type_store', 'uses' => 'FileController@storeType'
]);

$router->post("file/store",[
    'as' => 'file_store', 'uses' => 'FileController@storeFile'
]);