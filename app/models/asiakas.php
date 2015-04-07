<?php

class Asiakas extends BaseModel {

    public $tunnus, $nimi, $puhelinnumero;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_puhelinnumero');
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE Asiakkaat SET nimi = :nimi, puhelinnumero = :puhelinnumero WHERE tunnus = :tunnus');
        $query->execute(array('tunnus'=>$this->tunnus,'nimi' => $this->nimi, 'puhelinnumero' => $this->puhelinnumero));
    }

    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Asiakkaat WHERE tunnus = :tunnus');
        $query->execute(array('tunnus'=>$this->tunnus));
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Asiakkaat (nimi,puhelinnumero) VALUES (:nimi,:puhelinnumero) RETURNING tunnus');
        $query->execute(array('nimi' => $this->nimi, 'puhelinnumero' => $this->puhelinnumero));
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
