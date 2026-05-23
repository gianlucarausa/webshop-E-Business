--Skript ist idempotent
--Database
CREATE DATABASE IF NOT EXISTS webshop;
USE webshop;

--Create Befehle
CREATE TABLE IF NOT EXISTS Kunde (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzername VARCHAR(100) NOT NULL UNIQUE,
    vorname VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    ort VARCHAR(100) NOT NULL,
    plz VARCHAR(10) NOT NULL,
    strasse VARCHAR(100) NOT NULL,
    hausnummer VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS Kategorie (
    id INT PRIMARY KEY,
    parentid INT,
    name VARCHAR(100) NOT NULL UNIQUE,
    CONSTRAINT fk_parentid FOREIGN KEY (parentid) REFERENCES Kategorie(id)
);

CREATE TABLE IF NOT EXISTS Produkt (
    id INT PRIMARY KEY,
    kategorieid INT NOT NULL,
    bezeichnung VARCHAR(100) NOT NULL UNIQUE,
    beschreibung VARCHAR(100),
    bild VARCHAR(100) NOT NULL,
    preis DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_kategorie FOREIGN KEY (kategorieid) REFERENCES Kategorie(id)
);

CREATE TABLE IF NOT EXISTS Warenkorb (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kundeid INT NOT NULL,
    produktid INT NOT NULL,
    CONSTRAINT fk_kunde FOREIGN KEY (kundeid) REFERENCES Kunde(id),
    CONSTRAINT fk_produkt FOREIGN KEY (produktid) REFERENCES Produkt(id)
);

--Insert Befehle Kategorie
INSERT IGNORE INTO Kategorie VALUES (1, null, 'Getraenke');
INSERT IGNORE INTO Kategorie VALUES (2, null, 'Essen');
INSERT IGNORE INTO Kategorie VALUES (3, 1, 'Mate');
INSERT IGNORE INTO Kategorie VALUES (4, 1, 'Kaffee');
INSERT IGNORE INTO Kategorie VALUES (5, 2, 'Pizza');
INSERT IGNORE INTO Kategorie VALUES (6, 2, 'Pasta');

--Insert Befehle Produkt
--Mate
INSERT IGNORE INTO Produkt VALUES(1, 3,'Matritzen Mate Aschenbecher 330ml','Sehr erfrischend gerade an stressigen Tagen','../images/mm_ka2.jpg', 3.25);
INSERT IGNORE INTO Produkt VALUES(2, 3,'Matritzen Mate Original 330ml','Die altbewaehrte Originalrezeptur mit feinsten Mateblaettern aus Suedamerika','../images/mm_original2.jpg', 3.00);
INSERT IGNORE INTO Produkt VALUES(3, 3,'Matritzen Mate Summeredition 330ml','Ideal fuer heisse Sommertage<br>Am besten lauwarm','../images/mm_biotonne2.jpg', 3.50);
--Kaffee
INSERT IGNORE INTO Produkt VALUES(4, 4,'Gauss-Kaffee Original 220ml','Der originale Kaffee aus der Dose','../images/#', 4.00);
INSERT IGNORE INTO Produkt VALUES(5, 4,'Gauss-Kaffee Cappuchino 220ml','Der Kaffee aus der Dose aufgeschäumt mit Milch aus der regionalen Landwirtschaft','../images/#', 4.50);
INSERT IGNORE INTO Produkt VALUES(6, 4,'Gauss-Kaffee Wiener Melange 220ml','Dosenkaffee wie in den Kaffeehaeusern der Metropole an der Donau','../images/#', 4.80);
--Pizza
INSERT IGNORE INTO Produkt VALUES(7, 5,'Butter-Chicken-Pizza','Indisches Butter-Chicken kombiniert mit einer Pizza','../images/#', 8.50);
INSERT IGNORE INTO Produkt VALUES(8, 5,'Schinkenpizza','Feinste Pizza Speziale nach Rezeptur aus Italien','../images/#', 9.00);
INSERT IGNORE INTO Produkt VALUES(9, 5,'Spargelpizza','Exklusiv zur Spargelzeit - mit viel Hollondaise','../images/#', 12.50);
--Pasta
INSERT IGNORE INTO Produkt VALUES(10, 6,'Spaghetti alio e olio','Spaghetti mit Olivenoel und fein geschnittenem Knoblauch','../images/#', 9.00);
INSERT IGNORE INTO Produkt VALUES(11, 6,'Spaghetti Carbonara','Spaghetti mit Pecorino und Ei - evtl. mit Creme Fraiche gestreckt','../images/#', 11.90);
INSERT IGNORE INTO Produkt VALUES(12, 6,'Lasagne','Selbstgemacht und geschichtet mit hoechster Praezession','../images/#', 12.90);
