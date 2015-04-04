<?php

class Asiakas extends BaseModel {

    public $tunnus, $nimi, $puhelinnumero;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Asiakkaat (nimi,puhelinnumero) VALUES (:nimi,:puhelinnumero) RETURNING tunnus');
        $query->execute(array('nimi'=>$this->nimi,'puhelinnumero'=>$this->puhelinnumero));
        $row = $query->fetch();
        $this->tunnus = $row['tunnus'];
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Asiakkaat WHERE tunnus = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $asiakas = new Asiakas(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'puhelinnumero' => $row['puhelinnumero']
            ));
            return $asiakas;
        }
        return null;
    }

    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Asiakkaat');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();

        foreach ($rows as $row) {
            $asiakkaat[] = new Asiakas(array(
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'puhelinnumero' => $row['puhelinnumero']
            ));
        }
        return $asiakkaat;
    }
}
