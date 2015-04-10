<?php

$routes->post('/pankki/talleta',function(){
    PankkiController::talleta();
});
$routes->get('/pankki',function(){
    PankkiController::index();
});




$routes->post('/kauppa/:id/osta',function($id){
    KauppaController::osta($id);
});

$routes->get('/kauppa', function() {
    KauppaController::index();
});





$routes->post('/kirjanpito/:id/muokkaa', function($id) {
    KirjanpitoController::muokkaa($id);
});

$routes->get('/kirjanpito/:id/muokkaa', function($id) {
    KirjanpitoController::muokkaa($id);
});

$routes->post('/kirjanpito/:id/paivita', function($id) {
    KirjanpitoController::paivita($id);
});

$routes->post('/kirjanpito/:id/poista', function($id) {
    KirjanpitoController::poista($id);
});

$routes->post('/kirjanpito/uusi', function() {
    KirjanpitoController::tallenna();
});

$routes->get('/kirjanpito/uusi', function() {
    KirjanpitoController::uusi();
});

$routes->get('/kirjanpito', function() {
    KirjanpitoController::index();
});

$routes->get('/kirjanpito/:id', function($id) {
    KirjanpitoController::etsi($id);
});











$routes->post('/varasto/:id/muokkaa', function($id) {
    JuomaController::muokkaa($id);
});

$routes->get('/varasto/:id/muokkaa', function($id) {
    JuomaController::muokkaa($id);
});

$routes->post('/varasto/:id/paivita', function($id) {
    JuomaController::paivita($id);
});

$routes->post('/varasto/:id/poista', function($id) {
    JuomaController::poista($id);
});

$routes->post('/varasto/uusi', function() {
    JuomaController::tallenna();
});

$routes->get('/varasto/uusi', function() {
    JuomaController::uusi();
});

$routes->get('/varasto', function() {
    JuomaController::index();
});

$routes->get('/varasto/:id', function($id) {
    JuomaController::etsi($id);
});










$routes->post('/logout',function(){
    AsiakasController::logout();
});

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
