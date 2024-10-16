<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/reservations', 'Home::index');
$routes->post('/reservations/store', 'Home::store');
$routes->get('/reservations/getAvailableSeats/(:num)', 'Home::getAvailableSeats/$1');

