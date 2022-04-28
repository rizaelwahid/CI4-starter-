<?php
$routes->group("pangkat", ["namespace" => "\Modules\Ipanel\Controllers"], function ($routes) {
	$routes->get("/", "Pegawai::index");
});
