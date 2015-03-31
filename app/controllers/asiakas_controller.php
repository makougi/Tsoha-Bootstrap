<?php

require 'app/models/asiakas.php';

class AsiakasController extends BaseController {

    public static function kaikkiAsiakkaat() {
        $asiakkaat = Asiakas::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
        //View::make('asiakas/index.html');
    }
    public static function yksiAsiakas($id){
        $asiakas = Asiakas::yksi($id);
        
        View::make('asiakas/yksi.html', array('asiakas' => $asiakas));
    }
    public static function lisaaAsiakas(){
        View::make('lisays/asiakkaanLisays.html');
    }
    public static function uusiAsiakas(){
        $params = $_POST;
        $uusi = new Asiakas(array(
            'nimi' => $params['nimi'],
            'puhelinnumero' => $params['puhelinnumero']
        ));
        $uusi->tallenna  ();
        Redirect::to('lisays/asiakasLisatty/'.$uusi->id,array('message'=>'Asiakas lisätty'));
    }
    public static function asiakasLisatty(){
        View::make('lisays/asiakasLisatty.html');
    }

}
