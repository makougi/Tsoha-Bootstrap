<?php

require 'app/models/asiakas.php';

class AsiakasController extends BaseController {

    public static function kaikkiAsiakkaat() {
        $asiakkaat = Asiakas::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
        //View::make('asiakas/index.html');
    }

}
