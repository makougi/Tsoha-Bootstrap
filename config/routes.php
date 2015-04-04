<?php

$routes->post('/asiakas', function() {
    AsiakasController::tallenna();
});

$routes->get('/asiakas/uusi', function() {
    AsiakasController::uusi();
});

$routes->get('/asiakas', function() {
    AsiakasController::index();
});

$routes->get('/asiakas/:id', function($id) {
    AsiakasController::etsi($id);
});

$routes->get('/', function() {
    KaljaaController::home();
});
