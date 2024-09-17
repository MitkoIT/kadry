<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::index');
$routes->add('index', 'HomeController::index');
$routes->add('active', 'HomeController::getActiveUsers');
$routes->add('unactive', 'HomeController::getUnactiveUsers');
$routes->post('search', 'HomeController::getUserByName');
$routes->get('pass-success', 'HomeController::passSetSuccess');

$routes->get('passchng/(:num)', 'UserController::editUserPassword/$1');
$routes->get('setunactive/(:num)', 'UserController::setUserUnactive/$1');
$routes->get('edit/(:num)/(:num)', 'UserController::editUserDataForEdit/$1/$2');
$routes->post('store/(:num)/(:num)', 'UserController::setUserDataForEdit/$1/$2');
$routes->post('firstpasswd/(:num)', 'UserController::setUserPassword/$1');

$routes->add('paste', 'UserController::editUserDataForAdd');
$routes->post('add', 'UserController::setUserDataForAdd');
