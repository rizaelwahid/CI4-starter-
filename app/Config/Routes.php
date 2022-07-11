<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
// $routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultNamespace('Modules\Dashboard\Controllers');
// $routes->setDefaultController('Home');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
	return view('\Modules\Dashboard\Views\Layout\404');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Dashboard::index', ["filter" => "authrbac"]);

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

## Routes API Module Begin ##
$routes->group("apiAuth", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("/", "Auth::index");
	$routes->get("other/(:num)", "Auth::otherMethod/$1");
	$routes->post("login", "Auth::login");
});

$routes->group("apiPegawai", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("(:num)", "Pegawai::index/$1");
});
## Routes API Module End ##

## Routes Dashboard Module Begin ##
$routes->add('/forbidden', 'AppConfig::forbidden');
$routes->add('/maintenance', 'AppConfig::maintenance');

$routes->group("auth", ["namespace" => "\Modules\Dashboard\Controllers"], function ($routes) {
	$routes->add("login", "Auth::index");
	$routes->add("regsave", "Auth::regsave");
	$routes->add("forgotpassword", "Auth::forgotPassword");
	$routes->add("changepassword", "Auth::changePassword");
});

$routes->group("dashboard", ["namespace" => "\Modules\Dashboard\Controllers", "filter" => "authrbac"], function ($routes) {
	$routes->add("/", "Dashboard::index");
});

$routes->group("menu", ["namespace" => "\Modules\Dashboard\Controllers", "filter" => "authrbac"], function ($routes) {
	$routes->add("/", "Menu::index");
	$routes->add("create", "Menu::create");
	$routes->add("edit/(:num)", "Menu::edit/$1");
	$routes->add("trash", "Menu::trash");
	$routes->delete("(:num)", "Menu::delete/$1");
	$routes->add("restore/(:num)", "Menu::restore/$1");
	$routes->delete("harddelete/(:num)", "Menu::harddelete/$1");
	$routes->add("getMenuByTitle", "Menu::getMenuByTitle");
	$routes->add("accesscontrol", "Menu::accessControl");
});

$routes->group("permission", ["namespace" => "\Modules\Dashboard\Controllers", "filter" => "authrbac"], function ($routes) {
	$routes->add("/", "Permission::index");
	$routes->add("create", "Permission::create");
	$routes->add("edit/(:num)", "Permission::edit/$1");
	$routes->add("trash", "Permission::trash");
	$routes->delete("(:num)", "Permission::delete/$1");
	$routes->add("restore/(:num)", "Permission::restore/$1");
	$routes->delete("harddelete/(:num)", "Permission::harddelete/$1");
	$routes->add("accesscontrol", "Permission::accessControl");
});

$routes->group("user", ["namespace" => "\Modules\Dashboard\Controllers", "filter" => "authrbac"], function ($routes) {
	$routes->add("/", "User::index");
	$routes->add("create", "User::create");
	$routes->add("view/(:num)", "User::view/$1");
	$routes->add("edit/(:num)", "User::edit/$1");
	$routes->add("resetpassword/(:num)", "User::resetpassword/$1");
	$routes->add("trash", "User::trash");
	$routes->delete("(:num)", "User::delete/$1");
	$routes->add("restore/(:num)", "User::restore/$1");
	$routes->delete("harddelete/(:num)", "User::harddelete/$1");
});

$routes->group("role", ["namespace" => "\Modules\Dashboard\Controllers", "filter" => "authrbac"], function ($routes) {
	$routes->add("/", "Role::index");
	$routes->add("create", "Role::create");
	$routes->add("edit/(:num)", "Role::edit/$1");
	$routes->add("access", "Role::access");
	$routes->add("trash", "Role::trash");
	$routes->delete("(:num)", "Role::delete/$1");
	$routes->add("restore/(:num)", "Role::restore/$1");
	$routes->delete("harddelete/(:num)", "Role::harddelete/$1");
});
## Routes Dashboard Module End ##
