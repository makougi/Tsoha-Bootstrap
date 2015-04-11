<?php

class KirjanpitoController extends BaseController {

    public static function getStatus($id){
        $status = Kirjanpito::getStatus($id);
        return $status;
    }
    
    public static function getAsiakas($id) {
        $asiakas = Kirjanpito::etsi($id);
        return $asiakas;
    }

    public static function pienennaSaldoa($id, $summa) {
        self::check_logged_in();
        Kirjanpito::pienenna_saldoa($id, $summa);
    }

    public static function suurennaSaldoa($id, $summa) {
        self::check_logged_in();
        Kirjanpito::suurenna_saldoa($id, $summa);
    }

    public static function muokkaa($id) {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::etsi($id);
        View::make('kirjanpito/muokkaa.html', array('attributes' => $kirjanpito));
    }

    public static function paivita($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'tunnus' => $id,
            'saldo' => $params['saldo'],
            'status' => $params['status']
        );
        $kirjanpito = new Kirjanpito($attributes);
        $errors = $kirjanpito->errors();

        if (count($errors) > 0) {
            View::make('kirjanpito/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kirjanpito->paivita();
            Redirect::to('/kirjanpito/' . $kirjanpito->tunnus, array('viesti' => 'Kirjanpito päivitetty onnistuneesti!'
            ));
        }
    }

    public static function poista($id) {
        self::check_logged_in();
        $kirjanpito = new Kirjanpito(array('tunnus' => $id));
        $kirjanpito->poista();
//        Redirect::to('/kirjanpito', array('viesti' => 'Asiakkaan kirjanpitotiedot poistettu onnistuneesti!'
//        ));
    }

    public static function tallenna($tunnus) {
        $attributes = array(
            'tunnus' => $tunnus,
            'saldo' => 0,
            'status' => 'ok'
        );
        $asiakas = new Kirjanpito($attributes);
        $asiakas->tallenna();
    }

    public static function uusi() {
        View::make('kirjanpito/uusi.html');
    }

    public static function etsi($id) {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::etsi($id);
        $asiakas = Asiakas::etsi($id);
        View::make('kirjanpito/nayta.html', array('kirjanpito' => $kirjanpito, 'asiakas' => $asiakas));
    }

    public static function index() {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::kaikki();
        View::make('kirjanpito/index.html', array('kirjanpito' => $kirjanpito));
    }

}
