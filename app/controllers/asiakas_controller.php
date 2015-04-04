<?php

require 'app/models/asiakas.php';

class AsiakasController extends BaseController {

    public static function tallenna() {
        $params = $_POST;
        $asiakas = new Asiakas(array(
            'nimi' => $params['nimi'],
            'puhelinnumero' => $params['puhelinnumero']
        ));
        $asiakas->tallenna();
        Redirect::to('/asiakas/' . $asiakas->tunnus, array('viesti' => 'Asiakas on lisätty tietokantaan!'));
    }

    public static function uusi() {
        View::make('asiakas/uusi.html');
    }

    public static function etsi($id) {
        $asiakas = Asiakas::etsi($id);
        View::make('asiakas/nayta.html', array('asiakas' => $asiakas));
    }

    public static function index() {
        $asiakkaat = Asiakas::kaikki();
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
    }
}
