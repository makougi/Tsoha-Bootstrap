<?php

class KauppaController extends BaseController {

    public static function osta($id) {
        self::check_logged_in();
        $kauppa = Juoma::kaikki();
        $juoma = Juoma::etsi($id);
        if (Kirjanpito::getStatus($_POST['asiakastunnus']) == "esto") {
            View::make('kauppa/index.html', array('punainenviesti' => "Olet juonut liikaa :(", 'kauppa' => $kauppa));
        } else {
            if ($juoma->kpl > 0) {
                $juoma->vahennaMaaraa();
                Kirjanpito::pienennaSaldoa($_POST['asiakastunnus'], $juoma->hinta);
                View::make('kauppa/index.html', array('viesti' => "$juoma->juoma ostettu!", 'kauppa' => $kauppa));
            } else {
                View::make('kauppa/index.html', array('punainenviesti' => "$juoma->juoma on loppu :(", 'kauppa' => $kauppa));
            }
        }
    }

    public static function index() {
        self::check_logged_in();
        $kauppa = Juoma::kaikki();
        View::make('kauppa/index.html', array('kauppa' => $kauppa));
    }

}
