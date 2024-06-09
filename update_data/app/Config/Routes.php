<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/pages', 'Pages::index');
$routes->get('/pages/about', 'Pages::about');
$routes->get('/pages/contact', 'Pages::contact');
$routes->get('/buku', 'Buku::index');
$routes->get('/buku/create', 'Buku::create');
$routes->get('/buku/edit/(:segment)', 'Buku::edit/$1');
$routes->delete('/buku/(:num)', 'Buku::delete/$1');
$routes->get('/buku/(:any)', 'Buku::detail/$1');
