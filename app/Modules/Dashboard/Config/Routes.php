<?php
$routes->group("home", ["namespace" => "\Modules\Dashboard\Controllers"], function ($routes) {
	$routes->get("/", "Home::index");
});

$routes->group("menu", ["namespace" => "\Modules\Dashboard\Controllers"], function ($routes) {
	$routes->get("/", "Menu::index");
});
