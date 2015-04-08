<?php

$routes->get('/login',function(){
    AsiakasController::login();
});

$routes->post('/login',function(){
    AsiakasController::handle_login();
});

$routes->post('/asiakas/:id/muokkaa', function($id) {
    AsiakasController::muokkaa($id);
});

$routes->get('/asiakas/:id/muokkaa', function($id) {
    AsiakasController::muokkaa($id);
});

$routes->post('/asiakas/:id/paivita', function($id) {
    AsiakasController::paivita($id);
});

$routes->post('/asiakas/:id/poista', function($id) {
    AsiakasController::poista($id);
});

$routes->post('/asiakas/uusi', function() {
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
