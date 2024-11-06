<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ToDoListController::index');
$routes->add('/todo', 'ToDoListController::index');
$routes->add('/todo/completed', 'ToDoListController::getCompleteTask');
$routes->get('todo/create', 'ToDoListController::create');
$routes->post('todo/store', 'ToDoListController::store', ['as' => 'todo.store']);
$routes->get('todo/show/(:num)', 'ToDoListController::show/$1');
$routes->get('todo/edit/(:num)', 'ToDoListController::edit/$1');
$routes->put('/todo/update/(:segment)', 'ToDoListController::update/$1');
$routes->delete('/todo/delete/(:num)', 'ToDoListController::destroy/$1');



