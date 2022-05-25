<?php
$routes->group("dashboard", ["namespace" => "\Modules\Dashboard\Controllers"], function ($routes) {
	$routes->get("/", "Dashboard::index");
});

$routes->group("menu", ["namespace" => "\Modules\Dashboard\Controllers"], function ($routes) {
	$routes->get("/", "Menu::index");
});
