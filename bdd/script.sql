CREATE DATABASE IF NOT EXISTS ls_motors;
USE ls_motors;

-- =========================
-- TABLE UTILISATEUR
-- =========================
CREATE TABLE utilisateur (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Passwrd VARCHAR(255) NOT NULL,
    Role ENUM('admin','employe','joueur') NOT NULL DEFAULT 'joueur',
    DiscordPseudo VARCHAR(100) NULL,

    DateInscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLE CATEGORIE
-- =========================
CREATE TABLE categorie (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Libelle VARCHAR(100) NOT NULL
);

-- =========================
-- TABLE MARQUE
-- =========================
CREATE TABLE marque (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100) NOT NULL
);

-- =========================
-- TABLE VEHICULE
-- =========================
CREATE TABLE vehicule (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NomModele VARCHAR(150) NOT NULL,
    ID_Marque INT NOT NULL,
    ID_Categorie INT NOT NULL,
    PrixCatalogue DECIMAL(10,2) NOT NULL,
    Description TEXT,
    Image VARCHAR(255),
    Actif TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_vehicule_marque
        FOREIGN KEY (ID_Marque) REFERENCES marque(ID),
    CONSTRAINT fk_vehicule_categorie
        FOREIGN KEY (ID_Categorie) REFERENCES categorie(ID)
);

-- =========================
-- TABLE VENTE
-- =========================
CREATE TABLE vente (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_Employe INT NOT NULL,
    ID_Vehicule INT NOT NULL,
    NomClient VARCHAR(150) NOT NULL,
    DateVente DATETIME NOT NULL,
    PrixVente DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_vente_employe
        FOREIGN KEY (ID_Employe) REFERENCES utilisateur(ID),
    CONSTRAINT fk_vente_vehicule
        FOREIGN KEY (ID_Vehicule) REFERENCES vehicule(ID)
);

-- =========================
-- TABLE CONFIG
-- =========================
CREATE TABLE config (
    ID INT NOT NULL PRIMARY KEY
        COMMENT 'ID unique. Une seule ligne attendue (ID = 1).',
    MargePourcent DECIMAL(5,2) NOT NULL DEFAULT 40.00
        COMMENT 'Marge globale appliquée au prix catalogue (ex: 40.00 = +40%).',
    DateMaj DATETIME NOT NULL
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Date de dernière modification automatique.'
)
COMMENT='Table de configuration globale du système (1 seule ligne).';
INSERT IGNORE INTO config (ID, MargePourcent) VALUES (1, 40.00);

-- =========================
-- RDV / PANIER 
-- =========================
USE ls_motors;

CREATE TABLE IF NOT EXISTS rdv (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_Client INT NOT NULL,
    ID_Employe INT NULL,
    Statut VARCHAR(20) NOT NULL DEFAULT 'demande', -- demande | en_cours | valide | annule
    DateCreation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DateMaj DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_rdv_client FOREIGN KEY (ID_Client) REFERENCES utilisateur(ID),
    CONSTRAINT fk_rdv_employe FOREIGN KEY (ID_Employe) REFERENCES utilisateur(ID)
);

CREATE TABLE IF NOT EXISTS rdv_item (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_RDV INT NOT NULL,
    ID_Vehicule INT NOT NULL,
    Quantite INT NOT NULL DEFAULT 1,
    PrixUnitaire DECIMAL(10,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_rdvitem_rdv FOREIGN KEY (ID_RDV) REFERENCES rdv(ID) ON DELETE CASCADE,
    CONSTRAINT fk_rdvitem_vehicule FOREIGN KEY (ID_Vehicule) REFERENCES vehicule(ID)
);