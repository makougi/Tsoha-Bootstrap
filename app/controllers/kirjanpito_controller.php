<?php

class KirjanpitoController extends BaseController {

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

    public function muokkaa($id) {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::etsi($id);
        View::make('kirjanpito/muokkaa.html', array('attributes' => $kirjanpito));
    }

    public function paivita($id) {
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

    public function poista($id) {
        self::check_logged_in();
        $kirjanpito = new Kirjanpito(array('tunnus' => $id));
        $kirjanpito->poista();
        Redirect::to('/kirjanpito', array('viesti' => 'Asiakkaan kirjanpitotiedot poistettu onnistuneesti!'
        ));
    }

    public function tallenna() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'saldo' => $params['saldo'],
            'status' => $params['status']
        );
        $kirjanpito = new Kirjanpito($attributes);
        $errors = $kirjanpito->errors();

        if (count($errors) == 0) {
            if ($kirjanpito->samaaAsiakastaEiKirjanpidossa()) {
                $kirjanpito->tallenna();
                Redirect::to('/kirjanpito/' . $kirjanpito->tunnus, array('viesti' => 'Asiakas lisätty kirjanpitoon onnistuneesti!'));
            } else {
                $errors[] = 'Sama asiakas on jo kirjanpidossa!';
                View::make('kirjanpito/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
            }
        } else {
            View::make('kirjanpito/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public function uusi() {
        View::make('kirjanpito/uusi.html');
    }

    public static function etsi($id) {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::etsi($id);
        View::make('kirjanpito/nayta.html', array('kirjanpito' => $kirjanpito));
    }

    public static function index() {
        self::check_logged_in();
        $kirjanpito = Kirjanpito::kaikki();
        View::make('kirjanpito/index.html', array('kirjanpito' => $kirjanpito));
    }

}
