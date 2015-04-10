<?php

class Kauppa extends BaseModel {

    public function __construct($attributes) {
        parent::__construct($attributes);
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
