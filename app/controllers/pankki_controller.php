<?php

class PankkiController extends BaseController {

    public static function talleta() {
        Kirjanpito::suurennaSaldoa($_POST['tunnus'], $_POST['summa']);
        Kirjanpito::suurennaSaldoa(1, $_POST['summa']);//pankille rahaa, pankin tunnus tietokannassa oltava 1
        self::check_logged_in();
        $asiakas = Kirjanpito::etsi(BaseController::get_user_logged_in()->tunnus);
        View::make('pankki/index.html', array('asiakas' => $asiakas, 'summa' => $_POST['summa']));
    }

    public static function index() {
        self::check_logged_in();
        $asiakas = Kirjanpito::etsi(BaseController::get_user_logged_in()->tunnus);
        View::make('pankki/index.html', array('asiakas' => $asiakas));
    }

}
