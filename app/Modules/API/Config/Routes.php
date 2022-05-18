<?php
$routes->group("auth", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("/", "Auth::index");
	$routes->get("other/(:num)", "Auth::otherMethod/$1");
	$routes->post("login", "Auth::login");
});

$routes->group("pegawai", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("(:num)", "Pegawai::index/$1");
});
