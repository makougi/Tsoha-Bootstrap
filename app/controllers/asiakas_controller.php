<?php

require 'app/models/asiakas.php';

class AsiakasController extends BaseController {

    public static function muokkaa($id) {
        $asiakas = Asiakas::etsi($id);
        View::make('asiakas/muokkaa.html', array('attributes' => $asiakas));
    }

    public static function paivita($id) {
        $params = $_POST;

        $attributes = array(
            'tunnus' => $id,
            'nimi' => $params['nimi'],
            'puhelinnumero' => $params['puhelinnumero']
        );
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();
        
        if (count($errors) > 0) {
            View::make('asiakas/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $asiakas->paivita();
            Redirect::to('/asiakas/' . $asiakas->tunnus, array('viesti' => 'Asiakastiedot päivitetty onnistuneesti!'
            ));
        }
    }

    public static function poista($id) {
        $asiakas = new Asiakas(array('tunnus' => $id));
        $asiakas->poista();
        Redirect::to('/asiakas', array('viesti' => 'Asiakastili poistettu onnistuneesti!'
        ));
    }

    public static function tallenna() {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'puhelinnumero' => $params['puhelinnumero']
        );
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();

        if (count($errors) == 0) {
            $asiakas->tallenna();
            Redirect::to('/asiakas/' . $asiakas->tunnus, array('viesti' => 'Asiakas on lisätty tietokantaan!'));
        } else {
            View::make('asiakas/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
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
