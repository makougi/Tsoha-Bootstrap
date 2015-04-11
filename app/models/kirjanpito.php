<?php

class Kirjanpito extends BaseModel {

    public $tunnus, $saldo, $status;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_saldo');
    }

    public static function getStatus($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kirjanpito WHERE tunnus = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            return $row['status'];
        }
        return null;
    }

    public static function pienennaSaldoa($tunnus, $summa) {
        $query = DB::connection()->prepare('UPDATE Kirjanpito SET saldo = saldo-:summa WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus, 'summa' => $summa));
    }

    public static function suurennaSaldoa($tunnus, $summa) {
        $query = DB::connection()->prepare('UPDATE Kirjanpito SET saldo = saldo+:summa WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus, 'summa' => $summa));
    }

    public function samaaAsiakastaEiKirjanpidossa() {
        $query = DB::connection()->prepare('SELECT * FROM Kirjanpito WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
        $row = $query->fetch();
        if ($row) {
            return false;
        }
        return true;
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE Kirjanpito SET saldo = :saldo, status = :status WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus, 'saldo' => $this->saldo, 'status' => $this->status));
    }

    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Kirjanpito WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Kirjanpito (tunnus,saldo,status) VALUES (:tunnus, :saldo, :status)');
        $query->execute(array('tunnus' => $this->tunnus, 'saldo' => $this->saldo, 'status' => $this->status));
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kirjanpito WHERE tunnus = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kirjanpito = new Kirjanpito(array(
                'tunnus' => $row['tunnus'],
                'saldo' => $row['saldo'],
                'status' => $row['status']
            ));
            return $kirjanpito;
        }
        return null;
    }

    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Kirjanpito');
        $query->execute();
        $rows = $query->fetchAll();
        $kirjanpito = array();

        foreach ($rows as $row) {
            $kirjanpito[] = new Kirjanpito(array(
                'tunnus' => $row['tunnus'],
                'saldo' => $row['saldo'],
                'status' => $row['status']
            ));
        }
        return $kirjanpito;
    }

}
