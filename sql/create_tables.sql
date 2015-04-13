CREATE TABLE Asiakkaat(
  tunnus SERIAL PRIMARY KEY,
  kayttajatunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  puhelinnumero varchar(20) NOT NULL
);

CREATE TABLE Varasto(
  tunnus SERIAL PRIMARY KEY,
  juoma varchar(200) NOT NULL,
  kpl INTEGER,
  hinta FLOAT,
  tilavuus varchar(20), 
  alkoholiprosentti varchar(3),
  kuvaus varchar(200)
);

CREATE TABLE Kirjanpito(
  tunnus INTEGER REFERENCES Asiakkaat(tunnus),
  saldo FLOAT,
  status varchar(20)
);
