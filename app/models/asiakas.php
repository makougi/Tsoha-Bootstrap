<?php

class Asiakas extends BaseModel {

    public $tunnus, $kayttajatunnus, $salasana, $nimi, $puhelinnumero;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_kayttajatunnus', 'validate_nimi', 'validate_puhelinnumero');
    }

    public function KayttajatunnusOnVapaa() {
        $query = DB::connection()->prepare('SELECT * FROM Asiakkaat WHERE kayttajatunnus = :username');
        $query->execute(array('username' => $this->kayttajatunnus));
        $row = $query->fetch();
        if ($row) {
            return false;
        }
        return true;
    }

    public function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Asiakkaat WHERE kayttajatunnus = :username AND salasana = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $asiakas = new Asiakas(array(
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'puhelinnumero' => $row['puhelinnumero']
            ));
            return $asiakas;
        }
        return null;
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE Asiakkaat SET kayttajatunnus = :kayttajatunnus, salasana = :salasana, nimi = :nimi, puhelinnumero = :puhelinnumero WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus, 'kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'puhelinnumero' => $this->puhelinnumero));
    }

    public function poista($id) {
        $query = DB::connection()->prepare('DELETE FROM Asiakkaat WHERE tunnus = :id');
        $query->execute(array('id' => $this->tunnus));
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Asiakkaat (kayttajatunnus,salasana,nimi,puhelinnumero) VALUES (:kayttajatunnus,:salasana,:nimi,:puhelinnumero) RETURNING tunnus');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'puhelinnumero' => $this->puhelinnumero));
        $row = $query->fetch();
        $this->tunnus = $row['tunnus'];
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Asiakkaat WHERE tunnus = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $asiakas = new Asiakas(array(
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
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
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'tunnus' => $row['tunnus'],
                'nimi' => $row['nimi'],
                'puhelinnumero' => $row['puhelinnumero'],
            ));
        }
        return $asiakkaat;
    }

}
