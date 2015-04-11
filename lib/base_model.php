<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate_saldo() {
        $errors = array();
        if (!is_numeric($this->saldo)) {
            $errors[] = 'Saldon pitää olla luku. (Jos käytit pilkkua, käytä pistettä)';
        }
        return $errors;
    }

    public function validate_hinta() {
        $errors = array();
        if (!is_numeric($this->hinta)) {
            $errors[] = 'Hinnan pitää olla luku. (Jos käytit pilkkua, käytä pistettä)';
        }
        return $errors;
    }

    public function validate_kpl() {
        $errors = array();
        if (!ctype_digit($this->kpl)) {
            $errors[] = 'Kpl:n pitää olla kokonaisluku';
        }
        return $errors;
    }

    public function validate_juoma() {
        $errors = array();
        if ($this->juoma == '' || $this->juoma == null) {
            $errors[] = 'Juoman nimi ei saa olla tyhjä';
        }
        return $errors;
    }

    public function validate_kayttajatunnus() {
        $errors = array();
        if ($this->kayttajatunnus == '' || $this->kayttajatunnus == null) {
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä';
        }
        if (strlen($this->kayttajatunnus) < 2) {
            $errors[] = 'Käyttäjätunnuksen tulee olla vähintään kaksi merkkiä';
        }
        return $errors;
    }

    public function validate_puhelinnumero() {
        $errors = array();
        if ($this->puhelinnumero == '' || $this->puhelinnumero == null) {
            $errors[] = 'Puhelinnumero ei saa olla tyhjä';
        }
        if (is_numeric($this->puhelinnumero) == false) {
            $errors[] = 'Puhelinnumeron tulee sisältää vain numeroita';
        }
        if (strlen($this->puhelinnumero) < 8) {
            $errors[] = 'Puhelinnumerossa tulee olla vähintään kahdeksan numeroa';
        }
        return $errors;
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        if (strlen($this->nimi) < 2) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä';
        }
        return $errors;
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

}
