
CREATE TABLE Asiakkaat(
  tunnus SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  puhelinnumero varchar(20) NOT NULL
);

CREATE TABLE Juomat(
  juoma varchar(200) PRIMARY KEY,
  alkoholiprosentti INTEGER,
  kuvaus varchar(200)
);

CREATE TABLE Varasto(
  juoma varchar(200) PRIMARY KEY,
  maara INTEGER,
  hinta INTEGER
);
CREATE TABLE Kirjanpito(
  asiakastunnus SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  saldo INTEGER NOT NULL,
  status INTEGER NOT NULL
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