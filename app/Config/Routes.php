<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'auth::index');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');


if(session()->get('role_id') == 2){
	$routes->get('/users', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
	$routes->get('/users/(:any)', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
	$routes->get('/paket', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
	$routes->get('/paket/(:any)', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
	$routes->get('/jadwal', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
	$routes->get('/jadwal/(:any)', function(){
		throw new \CodeIgniter\Exceptions\PageNotFoundException();
	});
}


$routes->delete('/jemaah/(:num)', 				    'Jemaah::delete/$1');
$routes->get('/jemaah/excel/(:any)',                'Jemaah::excel/$1');
$routes->get('/jemaah/detail_haji/(:num)',          'Jemaah::detail_haji/$1');
$routes->get('/jemaah/detail_umroh/(:num)',         'Jemaah::detail_umroh/$1');
// $routes->get('/jemaah/(:any)', 'Jemaah::delete/$1');
$routes->get('/jemaah/createporsi/(:num)',          'Jemaah::createporsi/$1');
$routes->get('/jemaah/haji',                        'Jemaah::index');
$routes->get('/jemaah/umroh',                       'Jemaah::umroh');


$routes->delete('/pembayaran/(:num)', 				'Pembayaran::delete/$1');
$routes->get('/pembayaran/excel/(:any)',            'Pembayaran::excel/$1');
$routes->get('/pembayaran/detail/(:num)',           'Pembayaran::detail/$1');
// $routes->get('/pembayaran/(:any)', 'Pembayaran::delete/$1');
$routes->get('/pembayaran/haji',                    'Pembayaran::index');
$routes->get('/pembayaran/umroh',                   'Pembayaran::umroh');

// persyaratan
$routes->get('/persyaratan/create/(:num)', 			'Persyaratan::create/$1');
$routes->get('/persyaratan/(:any)', 			    'Persyaratan::detail/$1');


// controller porsiHaji
$routes->get('/porsiHaji/excel',                    'PorsiHaji::excel');
$routes->get('/porsiHaji/update',                   'PorsiHaji::update');

// controller paket
$routes->get('/paket/create', 				        'Paket::create');
$routes->get('/paket/edit/(:num)',                  'Paket::edit/$1');
$routes->delete('/paket/(:num)',                    'paket::delete/$1');

// controller jadwal
$routes->get('/jadwal/create', 				        'Jadwal::create');
$routes->get('/jadwal/edit/(:num)',                 'Jadwal::edit/$1');
$routes->delete('/jadwal/(:num)',                   'Jadwal::delete/$1');

// controller users
$routes->delete('/users/(:num)',                   'Users::delete/$1');

// api jemaah
$routes->get('/api_jemaah/cekEmail/(:segment)',    'Api_jemaah::cekEmail/$1');
$routes->resource('api_jemaah');

// api persyaratan
$routes->get('/api_persyaratan/detail/(:segment)',    'Api_persyaratan::detail/$1');
$routes->post('/api_persyaratan/update/(:segment)',    'Api_persyaratan::update/$1');

$routes->resource('api_persyaratan');

// api pembayaran
$routes->post('/api_pembayaran/update/(:segment)',    'Api_pembayaran::update/$1');
$routes->get('/api_pembayaran/(:segment)',    'Api_pembayaran::detail/$1');
$routes->resource('api_pembayaran');

// api paket
$routes->resource('api_paket');

// api jadwal
$routes->resource('api_jadwal');




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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
