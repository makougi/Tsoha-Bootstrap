-- Player-taulun testidata
--INSERT INTO Player (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
--INSERT INTO Player (name, password) VALUES ('Henri', 'Henri123');
-- Game taulun testidata
--INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());
INSERT INTO Asiakkaat (nimi, puhelinnumero) VALUES ('KASSA', '0');
INSERT INTO Asiakkaat (nimi, puhelinnumero) VALUES ('Kimmo', '0401231234');
INSERT INTO Asiakkaat (nimi, puhelinnumero) VALUES ('Petteri', '0404321432');
INSERT INTO Juomat (juoma, alkoholiprosentti, kuvaus) VALUES ('siideri','4','hyvää siideriä');
INSERT INTO Juomat (juoma, alkoholiprosentti, kuvaus) VALUES ('lonkero','4','hyvää lonkeroa');
