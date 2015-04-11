<?php

class Juoma extends BaseModel {

    public $tunnus, $juoma, $kpl, $hinta, $tilavuus, $alkoholiprosentti, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_juoma', 'validate_kpl', 'validate_hinta');
    }

    public function vahennaMaaraa() {
        $query = DB::connection()->prepare('UPDATE Varasto SET kpl = kpl-1 WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
    }

    public function SamaaJuomaaEiTietokannassa() {
        $query = DB::connection()->prepare('SELECT * FROM Varasto WHERE juoma = :juoma AND tilavuus = :tilavuus AND alkoholiprosentti = :alkoholiprosentti');
        $query->execute(array('juoma' => $this->juoma, 'tilavuus' => $this->tilavuus, 'alkoholiprosentti' => $this->alkoholiprosentti));
        $row = $query->fetch();
        if ($row) {
            return false;
        }
        return true;
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE Varasto SET juoma = :juoma, kpl = :kpl, hinta = :hinta, tilavuus = :tilavuus, alkoholiprosentti = :alkoholiprosentti, kuvaus = :kuvaus WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus, 'juoma' => $this->juoma, 'kpl' => $this->kpl, 'hinta' => $this->hinta, 'tilavuus' => $this->tilavuus, 'alkoholiprosentti' => $this->alkoholiprosentti, 'kuvaus' => $this->kuvaus));
    }

    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Varasto WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $this->tunnus));
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Varasto (juoma,kpl,hinta,tilavuus,alkoholiprosentti,kuvaus) VALUES (:juoma,:kpl,:hinta,:tilavuus,:alkoholiprosentti,:kuvaus) RETURNING tunnus');
        $query->execute(array('juoma' => $this->juoma, 'kpl' => $this->kpl, 'hinta' => $this->hinta, 'tilavuus' => $this->tilavuus, 'alkoholiprosentti' => $this->alkoholiprosentti, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        $this->tunnus = $row['tunnus'];
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Varasto WHERE tunnus = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $juoma = new Juoma(array(
                'tunnus' => $row['tunnus'],
                'juoma' => $row['juoma'],
                'kpl' => $row['kpl'],
                'hinta' => $row['hinta'],
                'tilavuus' => $row['tilavuus'],
                'alkoholiprosentti' => $row['alkoholiprosentti'],
                'kuvaus' => $row['kuvaus']
            ));
            return $juoma;
        }
        return null;
    }

    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Varasto');
        $query->execute();
        $rows = $query->fetchAll();
        $varasto = array();

        foreach ($rows as $row) {
            $varasto[] = new Juoma(array(
                'tunnus' => $row['tunnus'],
                'juoma' => $row['juoma'],
                'kpl' => $row['kpl'],
                'hinta' => $row['hinta'],
                'tilavuus' => $row['tilavuus'],
                'alkoholiprosentti' => $row['alkoholiprosentti'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $varasto;
    }

}
