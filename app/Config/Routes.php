<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::p_login');

// logout process
$routes->get('/logout', 'Home::p_logout');

//kelola kriteria
$routes->get('/dashboard', 'Admin\Dashboard::index', ['filter' => 'authFilter']);
$routes->get('/kriteria', 'Admin\Kriteria::index', ['filter' => 'authFilter']);
$routes->get('/kriteria/edit/(:num)', 'Admin\Kriteria::view_edit_kriteria/$1', ['filter' => 'authFilter']);
$routes->post('/kriteria', 'Admin\Kriteria::store', ['filter' => 'authFilter']);
$routes->post('/kriteria/(:num)', 'Admin\Kriteria::update/$1', ['filter' => 'authFilter']);
$routes->get('/kriteria/tambah', 'Admin\Kriteria::view_tambah_kriteria', ['filter' => 'authFilter']);

//kelola subkriteria
$routes->get('/sub/kriteria', 'Admin\SubKriteria::index', ['filter' => 'authFilter']);
$routes->post('/search', 'Admin\SubKriteria::search', ['filter' => 'authFilter']);
$routes->get('/sub/kriteria/tambah/(:num)', 'Admin\SubKriteria::add/$1', ['filter' => 'authFilter']);
$routes->get('/sub/kriteria/edit/(:num)', 'Admin\SubKriteria::edit/$1', ['filter' => 'authFilter']);
$routes->post('/sub/kriteria', 'Admin\SubKriteria::store', ['filter' => 'authFilter']);
$routes->get('/sub/kriteria/del/(:num)', 'Admin\SubKriteria::delete_all/$1', ['filter' => 'authFilter']);

//kelola alternatif
$routes->get('/alternatif', 'Admin\Alternatif::index', ['filter' => 'authFilter']);
$routes->get('/alternatif/tambah', 'Admin\Alternatif::add', ['filter' => 'authFilter']);
$routes->post('/alternatif', 'Admin\Alternatif::store', ['filter' => 'authFilter']);

//kelola Rank
$routes->get('/rank', 'Admin\Perangkingan::index', ['filter' => 'authFilter']);
$routes->get('/rank/add/(:num)', 'Admin\Perangkingan::add/$1', ['filter' => 'authFilter']);
$routes->post('/rank/(:num)', 'Admin\Perangkingan::store/$1', ['filter' => 'authFilter']);

$routes->get("/eksekusi", 'Admin\Perangkingan::saw');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
