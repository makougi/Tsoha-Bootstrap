<?php

class Asiakas extends BaseModel {

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public $tunnus, $nimi, $puhelinnumero;

    public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Asiakkaat');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $asiakkaat = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $asiakkaat[] = new Asiakas(array(
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'puhelinnumero' => $row['puhelinnumero'],
      ));
    }

    return $asiakkaat;
  }
}
