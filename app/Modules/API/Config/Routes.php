<?php
$routes->group("auth", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("/", "Auth::index");
	$routes->get("other", "Auth::otherMethod");
	$routes->post("login", "Auth::login");
});

$routes->group("pegawai", ["namespace" => "\Modules\API\Controllers"], function ($routes) {
	$routes->get("/", "Pegawai::index");
});
