<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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
$routes->get('/', 'Auth::index');
$routes->get('/register', 'Auth::register');
$routes->get('/forgot', 'Auth::forgot_password');
$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('/blok', 'Blok::index',['filter' => 'auth']);
$routes->get('/blok/add', 'Blok::add',['filter' => 'auth']);
$routes->get('/blok/edit', 'Blok::edit',['filter' => 'auth']);
$routes->get('/customer', 'Customer::index',['filter' => 'auth']);
$routes->get('/customer/add', 'Customer::add',['filter' => 'auth']);
$routes->get('/customer/edit', 'Customer::edit',['filter' => 'auth']);
$routes->get('/inbound', 'Inbound::index',['filter' => 'auth']);
$routes->get('/inbound/add', 'Inbound::add',['filter' => 'auth']);
$routes->get('/inbound/create', 'Inbound::create',['filter' => 'auth']);
$routes->get('/inboundhistory', 'InboundHistory::index',['filter' => 'auth']);
$routes->get('/location', 'Location::index',['filter' => 'auth']);
$routes->get('/location/add', 'Location::add',['filter' => 'auth']);
$routes->get('/location/create', 'Location::create',['filter' => 'auth']);
$routes->get('/locationdesign', 'LocationDesign::index',['filter' => 'auth']);
$routes->get('/locationdesign/add', 'LocationDesign::add',['filter' => 'auth']);
$routes->get('/locationdesign/create', 'LocationDesign::create',['filter' => 'auth']);
$routes->get('/locationplan', 'LocationPlan::index',['filter' => 'auth']);
$routes->get('/material', 'Material::index',['filter' => 'auth']);
$routes->get('/material/add', 'Material::add',['filter' => 'auth']);
$routes->get('/material/create', 'Material::create',['filter' => 'auth']);
$routes->get('/material/edit', 'Material::edit',['filter' => 'auth']);
$routes->get('/material/update', 'Material::update',['filter' => 'auth']);
$routes->get('/Uom', 'Uom::index',['filter' => 'auth']);
$routes->get('/Uom/add', 'Uom::add',['filter' => 'auth']);
$routes->get('/Uom/create', 'Uom::create',['filter' => 'auth']);
$routes->get('/Uom/edit', 'Uom::edit',['filter' => 'auth']);
$routes->get('/Uom/update', 'Uom::update',['filter' => 'auth']);
$routes->get('/out_realization', 'Out_realization::index',['filter' => 'auth']);
$routes->get('/out_realization/add', 'Out_realization::add',['filter' => 'auth']);
$routes->get('/out_realization/create', 'Out_realization::create',['filter' => 'auth']);
$routes->get('/outbound', 'Outbound::index',['filter' => 'auth']);
$routes->get('/outbound/add', 'Outbound::add',['filter' => 'auth']);
$routes->get('/outbound/create', 'Outbound::create',['filter' => 'auth']);
$routes->get('/owners', 'Owners::index',['filter' => 'auth']);
$routes->get('/owners/add', 'Owners::add',['filter' => 'auth']);
$routes->get('/owners/create', 'Owners::create',['filter' => 'auth']);
$routes->get('/owners/edit', 'Owners::edit',['filter' => 'auth']);
$routes->get('/owners/update', 'Owners::update',['filter' => 'auth']);
$routes->get('/purchaseorder', 'Purchaseorder::index',['filter' => 'auth']);
$routes->get('/purchaseorder/add', 'Purchaseorder::add',['filter' => 'auth']);
$routes->get('/purchaseorder/create', 'Purchaseorder::create',['filter' => 'auth']);
$routes->get('/rak', 'Rak::index',['filter' => 'auth']);
$routes->get('/rak/add', 'Rak::add',['filter' => 'auth']);
$routes->get('/rak/create', 'Rak::create',['filter' => 'auth']);
$routes->get('/rak/edit', 'Rak::edit',['filter' => 'auth']);
$routes->get('/rak/update', 'Rak::update',['filter' => 'auth']);
$routes->get('/realization', 'Realization::index',['filter' => 'auth']);
$routes->get('/realization/add', 'Realization::add',['filter' => 'auth']);
$routes->get('/realization/create', 'Realization::create',['filter' => 'auth']);
$routes->get('/shelf', 'Shelf::index',['filter' => 'auth']);
$routes->get('/shelf/add', 'Shelf::add',['filter' => 'auth']);
$routes->get('/shelf/create', 'Shelf::create',['filter' => 'auth']);
$routes->get('/shelf/edit', 'Shelf::edit',['filter' => 'auth']);
$routes->get('/shelf/update', 'Shelf::update',['filter' => 'auth']);
$routes->get('/supplier', 'Supplier::index',['filter' => 'auth']);
$routes->get('/supplier/add', 'Supplier::add',['filter' => 'auth']);
$routes->get('/supplier/create', 'Supplier::create',['filter' => 'auth']);
$routes->get('/supplier/edit', 'Supplier::edit',['filter' => 'auth']);
$routes->get('/supplier/update', 'Supplier::update',['filter' => 'auth']);
$routes->get('/warehouse', 'Warehouse::index',['filter' => 'auth']);
$routes->get('/warehouse/add', 'Warehouse::add',['filter' => 'auth']);
$routes->get('/warehouse/create', 'Warehouse::create',['filter' => 'auth']);
$routes->get('/warehouse/edit', 'Warehouse::edit',['filter' => 'auth']);
$routes->get('/warehouse/update', 'Warehouse::update',['filter' => 'auth']);
$routes->get('/warehouse', 'WhArea::index',['filter' => 'auth']);
$routes->get('/wharea/add', 'WhArea::add',['filter' => 'auth']);
$routes->get('/wharea/create', 'WhArea::create',['filter' => 'auth']);
$routes->get('/wharea/edit', 'WhArea::edit',['filter' => 'auth']);
$routes->get('/wharea/update', 'WhArea::update',['filter' => 'auth']);


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}