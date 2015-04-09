
-- CREATE TABLE Users(
--   kayttajatunnus varchar(50) PRIMARY KEY,
--   salasana varchar(50) NOT NULL
-- );

CREATE TABLE Asiakkaat(
  tunnus SERIAL PRIMARY KEY,
  kayttajatunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  puhelinnumero varchar(20) NOT NULL
);

CREATE TABLE Varasto(
  tunnus SERIAL PRIMARY KEY,
  juoma varchar(200),
  kpl varchar(10),
  hinta varchar(10),
  tilavuus varchar(10), 
  alkoholiprosentti varchar(10),
  kuvaus varchar(200)
);

CREATE TABLE Kirjanpito(
  asiakastunnus SERIAL PRIMARY KEY,
  saldo FLOAT NOT NULL,
  status varchar(20) NOT NULL
);
CREATE TABLE Loki(
  tapahtuma varchar(20),
  aika DATE,
  ID INTEGER,
  saldo INTEGER,
  juoma varchar(200),
  maara INTEGER,
  muut varchar(20)
);