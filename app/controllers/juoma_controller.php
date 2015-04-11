<?php

class JuomaController extends BaseController {

    public static function muokkaa($id) {
        self::check_logged_in();
        $juoma = Juoma::etsi($id);
        View::make('juoma/muokkaa.html', array('attributes' => $juoma));
    }

    public static function paivita($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'tunnus' => $id,
            'juoma' => $params['juoma'],
            'kpl' => $params['kpl'],
            'hinta' => $params['hinta'],
            'tilavuus' => $params['tilavuus'],
            'alkoholiprosentti' => $params['alkoholiprosentti'],
            'kuvaus' => $params['kuvaus']
        );
        $juoma = new Juoma($attributes);
        $errors = $juoma->errors();

        if (count($errors) == 0) {
//            if ($juoma->SamaaJuomaaEiTietokannassa()) {
                $juoma->paivita();
                Redirect::to('/varasto/' . $juoma->tunnus, array('viesti' => 'Juoman tiedot päivitetty!'));
//            } else {
//                $errors[] = 'Sama juoma on jo tietokannassa!';
//                View::make('juoma/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
//            }
        } else {
            View::make('juoma/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
//        
//        
//        
//        
//        
//        if (count($errors) > 0) {
//            View::make('juoma/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
//        } else {
//            $juoma->paivita();
//            Redirect::to('/varasto/' . $juoma->tunnus, array('viesti' => 'Juoman tiedot päivitetty onnistuneesti!'
//            ));
//        }
    }

    public static function poista($id) {
        self::check_logged_in();
        $juoma = new Juoma(array('tunnus' => $id));
        $juoma->poista();
        Redirect::to('/varasto', array('viesti' => 'Juoman tiedot poistettu onnistuneesti!'
        ));
    }

    public static function tallenna() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'juoma' => $params['juoma'],
            'kpl' => $params['kpl'],
            'hinta' => $params['hinta'],
            'tilavuus' => $params['tilavuus'],
            'alkoholiprosentti' => $params['alkoholiprosentti'],
            'kuvaus' => $params['kuvaus']
        );
        $juoma = new Juoma($attributes);
        $errors = $juoma->errors();

        if (count($errors) == 0) {
            if ($juoma->SamaaJuomaaEiTietokannassa()) {
                $juoma->tallenna();
                Redirect::to('/varasto/' . $juoma->tunnus, array('viesti' => 'Juoma on lisätty tietokantaan!'));
            } else {
                $errors[] = 'Sama juoma on jo tietokannassa!';
                View::make('juoma/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
            }
        } else {
            View::make('juoma/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function uusi() {
        View::make('juoma/uusi.html');
    }

    public static function etsi($id) {
        self::check_logged_in();
        $juoma = Juoma::etsi($id);
        View::make('juoma/nayta.html', array('juoma' => $juoma));
    }

    public static function index() {
        self::check_logged_in();
        $varasto = Juoma::kaikki();
        View::make('juoma/index.html', array('varasto' => $varasto));
    }

}
