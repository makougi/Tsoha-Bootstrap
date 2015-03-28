<?php
$routes->get('/kaikkiAsiakkaat', function() {
    AsiakasController::kaikkiAsiakkaat();
});
$routes->get('/', function() {
    KaljaaController::index();
});
$routes->get('/asiakas', function(){
    KaljaaController::asiakas();
});
$routes->get('/yllapitaja', function(){
    KaljaaController::yllapitaja();
});
$routes->get('/asiakkaat', function(){
    KaljaaController::asiakkaat();
});
$routes->get('/varasto', function(){
    KaljaaController::varasto();
});
$routes->get('/juoma', function(){
    KaljaaController::juoma();
});
$routes->get('/kirjanpito', function(){
    KaljaaController::kirjanpito();
});
$routes->get('/loki', function(){
    KaljaaController::loki();
});
$routes->get('/kirjautuminen', function(){
    KaljaaController::kirjautuminen();
});


