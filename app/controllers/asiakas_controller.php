<?php

class AsiakasController extends BaseController {

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function login() {
        View::make('asiakas/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = Asiakas::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('asiakas/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->tunnus;

            Redirect::to('/', array('viesti' => 'Tervetuloa takaisin, ' . $user->nimi . '!'));
        }
    }

    public static function muokkaa($id) {
        self::check_logged_in();
        $asiakas = Asiakas::etsi($id);
        View::make('asiakas/muokkaa.html', array('attributes' => $asiakas));
    }

    public static function paivita($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'tunnus' => $id,
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana'],
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
        self::check_logged_in();
        $asiakas = new Asiakas(array('tunnus' => $id));
        $asiakas->poista();
        Redirect::to('/asiakas', array('viesti' => 'Asiakastili poistettu onnistuneesti!'
        ));
    }

    public static function tallenna() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana'],
            'nimi' => $params['nimi'],
            'puhelinnumero' => $params['puhelinnumero']
        );
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();

        if (count($errors) == 0) {
            if ($asiakas->KayttajatunnusOnVapaa()) {
                $asiakas->tallenna();
                Redirect::to('/asiakas/' . $asiakas->tunnus, array('viesti' => 'Asiakas on lisätty tietokantaan!'));
            } else {
                $errors[] = 'Käyttäjätunnus on jo käytössä toisella käyttäjällä!';
                View::make('asiakas/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
            }
        } else {
            View::make('asiakas/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function uusi() {
        View::make('asiakas/uusi.html');
    }

    public static function etsi($id) {
        self::check_logged_in();
        $asiakas = Asiakas::etsi($id);
        View::make('asiakas/nayta.html', array('asiakas' => $asiakas));
    }

    public static function index() {
        self::check_logged_in();
        $asiakkaat = Asiakas::kaikki();
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
    }

}
