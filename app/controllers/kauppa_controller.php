<?php

class KauppaController extends BaseController {

    public static function osta($id) {
        self::check_logged_in();
        $kauppa = Juoma::kaikki();
        $juoma = Juoma::etsi($id);
        Kirjanpito::pienennaSaldoa($_POST['asiakastunnus'], $juoma->hinta);
        View::make('kauppa/index.html', array('ostettu_juoma' => $juoma->juoma, 'kauppa' => $kauppa));
    }

    public static function index() {
        self::check_logged_in();
        $kauppa = Juoma::kaikki();
        View::make('kauppa/index.html', array('kauppa' => $kauppa));
    }

}
