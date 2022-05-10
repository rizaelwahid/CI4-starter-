<?php
$routes->group("pangkat", ["namespace" => "\Modules\Ipanel\Controllers"], function ($routes) {
	$routes->get("/", "Pegawai::index");
});

$routes->group("menu", ["namespace" => "\Modules\Ipanel\Controllers"], function ($routes) {
	$routes->get("/", "Menu::index");
});
