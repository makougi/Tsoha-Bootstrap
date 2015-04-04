<?php

class KaljaaController extends BaseController {

    public static function home() {
        View::make('home.html');
    }

    public static function asiakas() {
        View::make('asiakas.html');
    }

    public static function yllapitaja() {
        View::make('yllapitaja.html');
    }

    public static function asiakkaat() {
        View::make('asiakkaat.html');
    }

    public static function varasto() {
        View::make('varasto.html');
    }

    public static function juoma() {
        View::make('juoma.html');
    }

    public static function kirjanpito() {
        View::make('kirjanpito.html');
    }

    public static function loki() {
        View::make('loki.html');
    }

    public static function kirjautuminen() {
        View::make('kirjautuminen.html');
    }

}
