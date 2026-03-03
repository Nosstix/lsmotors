-- =========================
-- INSERT DE BASE
-- =========================

-- Catégories de véhicules (LS MOTORS)
INSERT INTO categorie (Libelle) VALUES
('Sports'),
('Sport Classic'),
('Super'),
('Muscles'),
('Compact'),
('Coupe'),
('Sedans'),
('Moto'),
('SUV'),
('Offroad'),
('Vans utilitaire'),
('Boat'),
('Aircraft');

-- Marques
INSERT INTO marque (Nom) VALUES
('Albany'),
('Annis'),
('Benefactor'),
('BF'),
('Bollokan'),
('Bravado'),
('Brute'),
('Buckingham'),
('Canis'),
('Chariot'),
('Cheval'),
('Coil'),
('Declasse'),
('Dewbauchee'),
('Dinka'),
('Dundreary'),
('Emperor'),
('Enus'),
('Fathom'),
('Gallivanter'),
('Grotti'),
('Hijak'),
('HVY'),
('Imponte'),
('Invetero'),
('Jack Sheepe'),
('JoBuilt'),
('Karin'),
('Kraken Submersibles'),
('Lampadati'),
('Liberty City Cycles'),
('Maibatsu'),
('Mammoth'),
('Maxwell'),
('MTL'),
('Nagasaki'),
('Obey'),
('Ocelot'),
('Overflod'),
('Pegassi'),
('Pfister'),
('Principe'),
('Progen'),
('RUNE'),
('Schyster'),
('Shitzu'),
('Speedophile'),
('Stanley'),
('Truffade'),
('Ubermacht'),
('Vapid'),
('Vom Feuer'),
('Vulcar'),
('Vysser'),
('Weeny'),
('Western Company'),
('Western Motorcycle Company'),
('Willard'),
('Zirconium');

-- Création d'un admin par défaut
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('Admin', 'LS MOTORS', 'admin@lsmotors.local', 'admin123', 'admin', 'admin1');

-- Création d'un admin Noah
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('Brook', 'Noah', 'noahB@lsmotors.local', 'admin123', 'admin', 'Nosstix_15');

-- Création employé test
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('test', 'test', 'test@lsmotors.local', 'employe123', 'employe', 'employe1');

-- Création employé test2
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('test2', 'test2', 'test2@lsmotors.local', 'employe123', 'employe', 'employe2');

-- Création joueur test
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('joueur1', 'ridha', 'joueur1@fivem.com', 'joueur123', 'joueur', 'ridha148');

-- Création joueur test2
INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
VALUES ('joueur2', 'catherine', 'joueur2@fivem.com', 'joueur123', 'joueur', 'catherine556');


-- Sports
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Alpha', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 48000, NULL, NULL, 1),
('Bestia GTS', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 70000, NULL, NULL, 1),
('Buffalo', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 35000, NULL, NULL, 1),
('Buffalo S', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Carbonizzare', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 110000, NULL, NULL, 1),
('Comet', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 85000, NULL, NULL, 1),
('Comet5', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 95000, NULL, NULL, 1),
('Comet6', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 135000, NULL, NULL, 1),
('Coquette', (SELECT ID FROM marque WHERE Nom='Invetero'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 90000, NULL, NULL, 1),
('Drafter', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 120000, NULL, NULL, 1),
('Dynasty', (SELECT ID FROM marque WHERE Nom='Weeny'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 30000, NULL, NULL, 1),
('Elegy RH8', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 85000, NULL, NULL, 1),
('Elegy Retro', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 95000, NULL, NULL, 1),
('Feltzer', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 55000, NULL, NULL, 1),
('Flash GT', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 65000, NULL, NULL, 1),
('Fusilade', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 38000, NULL, NULL, 1),
('Futo', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 20000, NULL, NULL, 1),
('Futo2', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 28000, NULL, NULL, 1),
('GB200', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 55000, NULL, NULL, 1),
('Imorgon', (SELECT ID FROM marque WHERE Nom='Overflod'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 65000, NULL, NULL, 1),
('Infernus2', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 140000, NULL, NULL, 1),
('Issi7', (SELECT ID FROM marque WHERE Nom='Weeny'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 80000, NULL, NULL, 1),
('Italigto', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 110000, NULL, NULL, 1),
('Jester', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 60000, NULL, NULL, 1),
('Jester3', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Jester4', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 49000, NULL, NULL, 1),
('Jugular', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 150000, NULL, NULL, 1),
('Khamelion', (SELECT ID FROM marque WHERE Nom='Hijak'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 65000, NULL, NULL, 1),
('Komoda', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 95000, NULL, NULL, 1),
('Kuruma', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 80000, NULL, NULL, 1),
('Lynx', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Mamba', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 70000, NULL, NULL, 1),
('Massacro', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 65000, NULL, NULL, 1),
('Michelli', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 28000, NULL, NULL, 1),
('Neon', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 120000, NULL, NULL, 1),
('9F', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 85000, NULL, NULL, 1),
('9F Cabrio', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 95000, NULL, NULL, 1),
('Omnis', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Paragon', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 110000, NULL, NULL, 1),
('Pariah', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 140000, NULL, NULL, 1),
('Penumbra', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 22000, NULL, NULL, 1),
('Penumbra2', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 28000, NULL, NULL, 1),
('Peyote Gasser', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 35000, NULL, NULL, 1),
('Prairie', (SELECT ID FROM marque WHERE Nom='Bollokan'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 10000, NULL, NULL, 1),
('Rapid GT', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 80000, NULL, NULL, 1),
('Remus', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 30000, NULL, NULL, 1),
('RT3000', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 2000, NULL, NULL, 1),
('Ruston', (SELECT ID FROM marque WHERE Nom='Hijak'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 60000, NULL, NULL, 1),
('Revolter', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 90000, NULL, NULL, 1),
('Schafter V12', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Schafter4', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 50000, NULL, NULL, 1),
('Schlagen', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 80000, NULL, NULL, 1),
('Seven70', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 65000, NULL, NULL, 1),
('Specter', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Stratum', (SELECT ID FROM marque WHERE Nom='Zirconium'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 25000, NULL, NULL, 1),
('Streiter', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 55000, NULL, NULL, 1),
('Sugoi', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 25000, NULL, NULL, 1),
('Sultan', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Sultan2', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 20000, NULL, NULL, 1),
('Sultan3', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 60000, NULL, NULL, 1),
('Sultan RS', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 70000, NULL, NULL, 1),
('Surano', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 50000, NULL, NULL, 1),
('Swinger', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 85000, NULL, NULL, 1),
('Tampa2', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 75000, NULL, NULL, 1),
('Torero', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 110000, NULL, NULL, 1),
('Tropos', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 45000, NULL, NULL, 1),
('Turismo2', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 130000, NULL, NULL, 1),
('Vectre', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 42000, NULL, NULL, 1),
('Vstr', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 55000, NULL, NULL, 1),
('Zion3', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 36000, NULL, NULL, 1),
('ZR350', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 43000, NULL, NULL, 1),
('Growler', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 100000, NULL, NULL, 1),
('Comet S2 Cabrio', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Sports'), 137000, NULL, NULL, 1);



-- Sport Classics
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Btype', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 90000, NULL, NULL, 1),
('Btype Hotrod', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 180000, NULL, NULL, 1),
('Btype Luxe', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 120000, NULL, NULL, 1),
('Casco', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 140000, NULL, NULL, 1),
('Coquette Classic', (SELECT ID FROM marque WHERE Nom='Invetero'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 35000, NULL, NULL, 1),
('GT500', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 90000, NULL, NULL, 1),
('Stirling GT', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 75000, NULL, NULL, 1),
('Tornado Custom', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 32000, NULL, NULL, 1),
('Peyote Custom', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 38000, NULL, NULL, 1),
('Viseris', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 87500, NULL, NULL, 1),
('Z-Type', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Sport Classic'), 250000, NULL, NULL, 1);



-- Super
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Adder', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Super'), 260000, NULL, NULL, 1),
('Banshee 900R', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Super'), 145000, NULL, NULL, 1),
('Bullet', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Super'), 150000, NULL, NULL, 1),
('Champion', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Super'), 350000, NULL, NULL, 1),
('Cyclone', (SELECT ID FROM marque WHERE Nom='Coil'), (SELECT ID FROM categorie WHERE Libelle='Super'), 220000, NULL, NULL, 1),
('Cyclone2', (SELECT ID FROM marque WHERE Nom='Coil'), (SELECT ID FROM categorie WHERE Libelle='Super'), 260000, NULL, NULL, 1),
('Entity XF', (SELECT ID FROM marque WHERE Nom='Overflod'), (SELECT ID FROM categorie WHERE Libelle='Super'), 320000, NULL, NULL, 1),
('Entity XXR', (SELECT ID FROM marque WHERE Nom='Overflod'), (SELECT ID FROM categorie WHERE Libelle='Super'), 350000, NULL, NULL, 1),
('ETR1', (SELECT ID FROM marque WHERE Nom='Progen'), (SELECT ID FROM categorie WHERE Libelle='Super'), 240000, NULL, NULL, 1),
('FMJ', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Super'), 260000, NULL, NULL, 1),
('GP1', (SELECT ID FROM marque WHERE Nom='Progen'), (SELECT ID FROM categorie WHERE Libelle='Super'), 650000, NULL, NULL, 1),
('Ignus', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 420000, NULL, NULL, 1),
('Infernus', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 180000, NULL, NULL, 1),
('Krieger', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Super'), 480000, NULL, NULL, 1),
('Itali RSX', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 420000, NULL, NULL, 1),
('Nero', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Super'), 300000, NULL, NULL, 1),
('Nero Custom', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Super'), 350000, NULL, NULL, 1),
('Osiris', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 390000, NULL, NULL, 1),
('Penetrator', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Super'), 250000, NULL, NULL, 1),
('Pfister Astron Custom', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Super'), 280000, NULL, NULL, 1),
('RE-7B', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Super'), 630000, NULL, NULL, 1),
('S80RR', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Super'), 700000, NULL, NULL, 1),
('SC1', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Super'), 310000, NULL, NULL, 1),
('Sheava', (SELECT ID FROM marque WHERE Nom='Emperor'), (SELECT ID FROM categorie WHERE Libelle='Super'), 290000, NULL, NULL, 1),
('T20', (SELECT ID FROM marque WHERE Nom='Progen'), (SELECT ID FROM categorie WHERE Libelle='Super'), 450000, NULL, NULL, 1),
('Taipan', (SELECT ID FROM marque WHERE Nom='Cheval'), (SELECT ID FROM categorie WHERE Libelle='Super'), 380000, NULL, NULL, 1),
('Tezeract', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 720000, NULL, NULL, 1),
('Thrax', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Super'), 500000, NULL, NULL, 1),
('Turismo R', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 400000, NULL, NULL, 1),
('Tyrant', (SELECT ID FROM marque WHERE Nom='Truffade'), (SELECT ID FROM categorie WHERE Libelle='Super'), 330000, NULL, NULL, 1),
('Tyrus', (SELECT ID FROM marque WHERE Nom='Progen'), (SELECT ID FROM categorie WHERE Libelle='Super'), 250000, NULL, NULL, 1),
('Vacca', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 210000, NULL, NULL, 1),
('Vagner', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Super'), 510000, NULL, NULL, 1),
('Vigilante', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Super'), 600000, NULL, NULL, 1),
('Visione', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 690000, NULL, NULL, 1),
('Zeno', (SELECT ID FROM marque WHERE Nom='Overflod'), (SELECT ID FROM categorie WHERE Libelle='Super'), 330000, NULL, NULL, 1),
('Zentorno', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 620000, NULL, NULL, 1),
('Emerus', (SELECT ID FROM marque WHERE Nom='Progen'), (SELECT ID FROM categorie WHERE Libelle='Super'), 900000, NULL, NULL, 1),
('Deveste Eight', (SELECT ID FROM marque WHERE Nom='Principe'), (SELECT ID FROM categorie WHERE Libelle='Super'), 750000, NULL, NULL, 1),
('Itali GTO Stinger TT', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 820000, NULL, NULL, 1),
('Torero XO', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 680000, NULL, NULL, 1),
('Virtue', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Super'), 720000, NULL, NULL, 1),
('LM87', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Super'), 460000, NULL, NULL, 1),
('Cyclone Custom', (SELECT ID FROM marque WHERE Nom='Coil'), (SELECT ID FROM categorie WHERE Libelle='Super'), 480000, NULL, NULL, 1),
('Furia', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 90000, NULL, NULL, 1),
('Growler RR', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='Super'), 250000, NULL, NULL, 1),
('Reaper', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Super'), 750000, NULL, NULL, 1),
('X80 Proto', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Super'), 90000, NULL, NULL, 1);



-- Muscles
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Blade', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Buccaneer', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 25000, NULL, NULL, 1),
('Buccaneer Rider', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 35000, NULL, NULL, 1),
('Chino', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 34000, NULL, NULL, 1),
('Chino Luxe', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Clique', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Deviant', (SELECT ID FROM marque WHERE Nom='Schyster'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 65000, NULL, NULL, 1),
('Dominator', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Dominator2', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 50000, NULL, NULL, 1),
('Dominator3', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 52000, NULL, NULL, 1),
('Dominator GTX', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 78000, NULL, NULL, 1),
('Dukes', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 30000, NULL, NULL, 1),
('Dukes3', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 34000, NULL, NULL, 1),
('Ellie', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 55000, NULL, NULL, 1),
('Faction', (SELECT ID FROM marque WHERE Nom='Willard'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 25000, NULL, NULL, 1),
('Faction Rider', (SELECT ID FROM marque WHERE Nom='Willard'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 30000, NULL, NULL, 1),
('Faction3 (Donk)', (SELECT ID FROM marque WHERE Nom='Willard'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 38000, NULL, NULL, 1),
('Gauntlet', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 35000, NULL, NULL, 1),
('Gauntlet2', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Gauntlet3', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 52000, NULL, NULL, 1),
('Gauntlet4', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 60000, NULL, NULL, 1),
('Gauntlet5', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 65000, NULL, NULL, 1),
('Hermes', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 50000, NULL, NULL, 1),
('Hustler', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 48000, NULL, NULL, 1),
('Hotknife', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 60000, NULL, NULL, 1),
('Impaler', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Impaler2', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 50000, NULL, NULL, 1),
('Impaler3', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 52000, NULL, NULL, 1),
('Impaler4', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 55000, NULL, NULL, 1),
('Nightshade', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 52000, NULL, NULL, 1),
('Phoenix', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 18000, NULL, NULL, 1),
('Picador', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 15000, NULL, NULL, 1),
('Ratloader', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 12000, NULL, NULL, 1),
('Ratloader2', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 25000, NULL, NULL, 1),
('Ruiner', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 35000, NULL, NULL, 1),
('Ruiner2', (SELECT ID FROM marque WHERE Nom='Imponte'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 45000, NULL, NULL, 1),
('Sabre Turbo', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 32000, NULL, NULL, 1),
('Sabre Turbo Custom', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 38000, NULL, NULL, 1),
('Tampa', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 38000, NULL, NULL, 1),
('Tampa2', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 75000, NULL, NULL, 1),
('Vigero', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 28000, NULL, NULL, 1),
('Virgo', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 32000, NULL, NULL, 1),
('Yosemite', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 42000, NULL, NULL, 1),
('Vamos', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 29250, NULL, NULL, 1),
('Tulip', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 29250, NULL, NULL, 1),
('Yosemite3', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 16000, NULL, NULL, 1),
('Voodoo', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Muscles'), 22000, NULL, NULL, 1);



-- Compacts
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Asbo', (SELECT ID FROM marque WHERE Nom='Maxwell'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 10000, NULL, NULL, 1),
('Blista', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 16000, NULL, NULL, 1),
('Blista Compact (Blista2)', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 20000, NULL, NULL, 1),
('Brioso RA (Brioso)', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 18000, NULL, NULL, 1),
('Brioso 300 (Brioso2)', (SELECT ID FROM marque WHERE Nom='Grotti'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 16000, NULL, NULL, 1),
('Club', (SELECT ID FROM marque WHERE Nom='BF'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 22000, NULL, NULL, 1),
('Dilettante', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 12000, NULL, NULL, 1),
('Issi', (SELECT ID FROM marque WHERE Nom='Weeny'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 10000, NULL, NULL, 1),
('Weevil', (SELECT ID FROM marque WHERE Nom='BF'), (SELECT ID FROM categorie WHERE Libelle='Compact'), 8000, NULL, NULL, 1);



-- Coupes
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Cognoscenti Cabrio', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 60000, NULL, NULL, 1),
('Exemplar', (SELECT ID FROM marque WHERE Nom='Dewbauchee'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 55000, NULL, NULL, 1),
('F620', (SELECT ID FROM marque WHERE Nom='Ocelot'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 45000, NULL, NULL, 1),
('Felon', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 40000, NULL, NULL, 1),
('Felon GT', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 50000, NULL, NULL, 1),
('Windsor', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 75000, NULL, NULL, 1),
('Windsor2', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 85000, NULL, NULL, 1),
('Zion', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 28000, NULL, NULL, 1),
('Zion2', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 34000, NULL, NULL, 1),
('Zion3', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='Coupe'), 36000, NULL, NULL, 1);



-- Sedans
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Asea', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 14500, NULL, NULL, 1),
('Asterope', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 18000, NULL, NULL, 1),
('Cheburek', (SELECT ID FROM marque WHERE Nom='RUNE'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 12000, NULL, NULL, 1),
('Cognoscenti', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 70000, NULL, NULL, 1),
('Emperor', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 7000, NULL, NULL, 1),
('Emperor2', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 8000, NULL, NULL, 1),
('Fugitive', (SELECT ID FROM marque WHERE Nom='Cheval'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 25000, NULL, NULL, 1),
('Glendale', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 12000, NULL, NULL, 1),
('Glendale Custom', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 18000, NULL, NULL, 1),
('Intruder', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 9000, NULL, NULL, 1),
('Premier', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 15000, NULL, NULL, 1),
('Primo', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 20000, NULL, NULL, 1),
('Primo Custom', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 30000, NULL, NULL, 1),
('Raiden', (SELECT ID FROM marque WHERE Nom='Coil'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 110000, NULL, NULL, 1),
('Schafter', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 20000, NULL, NULL, 1),
('Stanier', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 20000, NULL, NULL, 1),
('Stratum', (SELECT ID FROM marque WHERE Nom='Zirconium'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 25000, NULL, NULL, 1),
('Surge', (SELECT ID FROM marque WHERE Nom='Cheval'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 25000, NULL, NULL, 1),
('Tailgater', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 20000, NULL, NULL, 1),
('Tailgater2', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 100000, NULL, NULL, 1),
('Washington', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 18000, NULL, NULL, 1),
('Cinquemila', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 65000, NULL, NULL, 1),
('Deity', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='Sedans'), 69000, NULL, NULL, 1);


-- Motos
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Avarus', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 22000, NULL, NULL, 1),
('Bagger', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 13000, NULL, NULL, 1),
('Bati 801', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 16000, NULL, NULL, 1),
('Bati 801RR', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 21000, NULL, NULL, 1),
('BF400', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 8500, NULL, NULL, 1),
('Carbon RS', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 28000, NULL, NULL, 1),
('Cliffhanger', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 22000, NULL, NULL, 1),
('Cruiser', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 7000, NULL, NULL, 1),
('Daemon', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 10000, NULL, NULL, 1),
('Daemon High', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 12000, NULL, NULL, 1),
('Defiler', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 27000, NULL, NULL, 1),
('Diabolus', (SELECT ID FROM marque WHERE Nom='Principe'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 18000, NULL, NULL, 1),
('Diabolus Custom (Diabolus2)', (SELECT ID FROM marque WHERE Nom='Principe'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 22000, NULL, NULL, 1),
('Double T', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 30000, NULL, NULL, 1),
('Enduro', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 6000, NULL, NULL, 1),
('Esskey', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 8000, NULL, NULL, 1),
('Faggio', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 4000, NULL, NULL, 1),
('Faggio Mod (Faggio2)', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 5000, NULL, NULL, 1),
('FCR', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 40000, NULL, NULL, 1),
('FCR2', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 45000, NULL, NULL, 1),
('Gargoyle', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 14000, NULL, NULL, 1),
('Hakuchou', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 28000, NULL, NULL, 1),
('Hakuchou Drag', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 40000, NULL, NULL, 1),
('Hexer', (SELECT ID FROM marque WHERE Nom='Liberty City Cycles'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 12000, NULL, NULL, 1),
('Innovation', (SELECT ID FROM marque WHERE Nom='Liberty City Cycles'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 18000, NULL, NULL, 1),
('Manchez', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 15000, NULL, NULL, 1),
('Nightblade', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 50000, NULL, NULL, 1),
('Nemesis', (SELECT ID FROM marque WHERE Nom='Principe'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 25000, NULL, NULL, 1),
('Ruffian', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 13000, NULL, NULL, 1),
('Sanchez', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 7500, NULL, NULL, 1),
('Sanchez2 (Sanchez Sport)', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 10500, NULL, NULL, 1),
('Sanctus', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 75000, NULL, NULL, 1),
('Vader', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 12000, NULL, NULL, 1),
('Vindicator', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 35000, NULL, NULL, 1),
('Vortex', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 20000, NULL, NULL, 1),
('Wolfsbane', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 8500, NULL, NULL, 1),
('Zombie', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 9500, NULL, NULL, 1),
('Zombie2', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 12000, NULL, NULL, 1),
('Reever', (SELECT ID FROM marque WHERE Nom='Western Motorcycle Company'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 20000, NULL, NULL, 1),
('Shinobi', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Moto'), 29000, NULL, NULL, 1);



-- SUVs
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Baller Sport', (SELECT ID FROM marque WHERE Nom='Gallivanter'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 55000, NULL, NULL, 1),
('BJXL', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('Cavalcade', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 30000, NULL, NULL, 1),
('Cavalcade2', (SELECT ID FROM marque WHERE Nom='Albany'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('Granger', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 45000, NULL, NULL, 1),
('Gresley', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 50000, NULL, NULL, 1),
('Habanero', (SELECT ID FROM marque WHERE Nom='Emperor'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 20000, NULL, NULL, 1),
('Huntley S', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 85000, NULL, NULL, 1),
('Radius', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 22000, NULL, NULL, 1),
('Seminole', (SELECT ID FROM marque WHERE Nom='Canis'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 20000, NULL, NULL, 1),
('Seminole2', (SELECT ID FROM marque WHERE Nom='Canis'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('Toros', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 91000, NULL, NULL, 1),
('Novak', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 45000, NULL, NULL, 1),
('Landstalker', (SELECT ID FROM marque WHERE Nom='Dundreary'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 25000, NULL, NULL, 1),
('Landstalker2', (SELECT ID FROM marque WHERE Nom='Dundreary'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('Rebla', (SELECT ID FROM marque WHERE Nom='Ubermacht'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('Rocoto', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 35000, NULL, NULL, 1),
('XLS', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 32000, NULL, NULL, 1),
('Astron', (SELECT ID FROM marque WHERE Nom='Pfister'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 103000, NULL, NULL, 1),
('Baller7 (Baller ST)', (SELECT ID FROM marque WHERE Nom='Gallivanter'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 55000, NULL, NULL, 1),
('Granger2 (3600LX)', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 65000, NULL, NULL, 1),
('Iwagen', (SELECT ID FROM marque WHERE Nom='Obey'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 66000, NULL, NULL, 1),
('Jubilee', (SELECT ID FROM marque WHERE Nom='Enus'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 67000, NULL, NULL, 1),
('Patriot', (SELECT ID FROM marque WHERE Nom='Mammoth'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 45000, NULL, NULL, 1),
('Patriot2', (SELECT ID FROM marque WHERE Nom='Mammoth'), (SELECT ID FROM categorie WHERE Libelle='SUV'), 120000, NULL, NULL, 1);



-- OFFROAD
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('BF Injection', (SELECT ID FROM marque WHERE Nom='BF'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 22000, NULL, NULL, 1),
('Bifta', (SELECT ID FROM marque WHERE Nom='BF'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 18000, NULL, NULL, 1),
('Blazer', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 14000, NULL, NULL, 1),
('Blazer4', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 16000, NULL, NULL, 1),
('Brawler', (SELECT ID FROM marque WHERE Nom='Coil'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 75000, NULL, NULL, 1),
('Dubsta 6x6', (SELECT ID FROM marque WHERE Nom='Benefactor'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 90000, NULL, NULL, 1),
('Dloader', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 30000, NULL, NULL, 1),
('Dune Buggy', (SELECT ID FROM marque WHERE Nom='BF'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 15000, NULL, NULL, 1),
('Everon', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 65000, NULL, NULL, 1),
('Guardian', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 55000, NULL, NULL, 1),
('Hellion', (SELECT ID FROM marque WHERE Nom='Annis'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 42000, NULL, NULL, 1),
('Freecrawler', (SELECT ID FROM marque WHERE Nom='Canis'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 50000, NULL, NULL, 1),
('Kamacho', (SELECT ID FROM marque WHERE Nom='Canis'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 150000, NULL, NULL, 1),
('Kalahari', (SELECT ID FROM marque WHERE Nom='Canis'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 22000, NULL, NULL, 1),
('Outlaw', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 40000, NULL, NULL, 1),
('Rebel', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 25000, NULL, NULL, 1),
('Rebel2', (SELECT ID FROM marque WHERE Nom='Karin'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 30000, NULL, NULL, 1),
('Riata', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 80000, NULL, NULL, 1),
('Sandking', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 60000, NULL, NULL, 1),
('Sandking2', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 50000, NULL, NULL, 1),
('Squaddie', (SELECT ID FROM marque WHERE Nom='Mammoth'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 40000, NULL, NULL, 1),
('Vagrant', (SELECT ID FROM marque WHERE Nom='Maxwell'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 45000, NULL, NULL, 1),
('Verus', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 45000, NULL, NULL, 1),
('Caracara2', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Offroad'), 55000, NULL, NULL, 1);



-- Vans / Utilitaires
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Bison', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 28000, NULL, NULL, 1),
('Bison2', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('Burrito2', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 22000, NULL, NULL, 1),
('Burrito3', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 55000, NULL, NULL, 1),
('Burrito4', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 25000, NULL, NULL, 1),
('Gang Burrito', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('Bobcat XL', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 35000, NULL, NULL, 1),
('Speedo', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 16000, NULL, NULL, 1),
('Speedo2', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 18000, NULL, NULL, 1),
('Rumpo', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 12000, NULL, NULL, 1),
('Rumpo2', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 15000, NULL, NULL, 1),
('Rumpo3', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 20000, NULL, NULL, 1),
('Moonbeam', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 16000, NULL, NULL, 1),
('Moonbeam Rider', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('Youga', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 18000, NULL, NULL, 1),
('Youga2', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 22000, NULL, NULL, 1),
('Youga3', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('Youga4', (SELECT ID FROM marque WHERE Nom='Bravado'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 20000, NULL, NULL, 1),
('Boxville', (SELECT ID FROM marque WHERE Nom='Brute'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 25000, NULL, NULL, 1),
('Boxville2', (SELECT ID FROM marque WHERE Nom='Brute'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('Boxville3', (SELECT ID FROM marque WHERE Nom='Brute'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 35000, NULL, NULL, 1),
('Mule', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 38000, NULL, NULL, 1),
('Mule2', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 45000, NULL, NULL, 1),
('Mule3', (SELECT ID FROM marque WHERE Nom='Maibatsu'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 50000, NULL, NULL, 1),
('Benson', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 30000, NULL, NULL, 1),
('New Speedo (nspeedo)', (SELECT ID FROM marque WHERE Nom='Vapid'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 85000, NULL, NULL, 1),
('Burrito6', (SELECT ID FROM marque WHERE Nom='Declasse'), (SELECT ID FROM categorie WHERE Libelle='Vans utilitaire'), 86000, NULL, NULL, 1);



-- Boats
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Dinghy', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 25000, NULL, NULL, 1),
('Dinghy2', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 28000, NULL, NULL, 1),
('Dinghy4', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 250000, NULL, NULL, 1),
('Jetmax', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 45000, NULL, NULL, 1),
('Marquis', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 60000, NULL, NULL, 1),
('Seashark', (SELECT ID FROM marque WHERE Nom='Speedophile'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 9000, NULL, NULL, 1),
('Seashark2', (SELECT ID FROM marque WHERE Nom='Speedophile'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 10000, NULL, NULL, 1),
('Speeder', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 45000, NULL, NULL, 1),
('Speeder2', (SELECT ID FROM marque WHERE Nom='Pegassi'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 50000, NULL, NULL, 1),
('Squalo', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 38000, NULL, NULL, 1),
('Suntrap', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 28000, NULL, NULL, 1),
('Toro2', (SELECT ID FROM marque WHERE Nom='Lampadati'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 500000, NULL, NULL, 1),
('Tropic', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 38000, NULL, NULL, 1),
('Tropic2', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 42000, NULL, NULL, 1),
('Longfin', (SELECT ID FROM marque WHERE Nom='Shitzu'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 700000, NULL, NULL, 1),
('Patrol Boat', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 75000, NULL, NULL, 1),
('Kraken', (SELECT ID FROM marque WHERE Nom='Kraken Submersibles'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 220000, NULL, NULL, 1),
('Catalina Dinghy', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 38000, NULL, NULL, 1),
('Submersible', (SELECT ID FROM marque WHERE Nom='Kraken Submersibles'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 450000, NULL, NULL, 1),
('Yacht SR650 (sr650fly)', (SELECT ID FROM marque WHERE Nom='Dinka'), (SELECT ID FROM categorie WHERE Libelle='Boat'), 4000000, NULL, NULL, 1);



-- AIRCRAFT
INSERT INTO vehicule (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif) VALUES
('Cuban 800', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 120000, NULL, NULL, 1),
('Dodo', (SELECT ID FROM marque WHERE Nom='Mammoth'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 150000, NULL, NULL, 1),
('Frogger', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 250000, NULL, NULL, 1),
('Frogger2', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 280000, NULL, NULL, 1),
('Havok', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 210000, NULL, NULL, 1),
('Mammatus', (SELECT ID FROM marque WHERE Nom='JoBuilt'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 90000, NULL, NULL, 1),
('Microlight', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 35000, NULL, NULL, 1),
('Velum', (SELECT ID FROM marque WHERE Nom='JoBuilt'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 180000, NULL, NULL, 1),
('Velum2', (SELECT ID FROM marque WHERE Nom='JoBuilt'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 210000, NULL, NULL, 1),
('Vestra', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 310000, NULL, NULL, 1),
('Swift', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 650000, NULL, NULL, 1),
('Swift Deluxe', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1700000, NULL, NULL, 1),
('SuperVolito2', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1000000, NULL, NULL, 1),
('Volatus', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 2000000, NULL, NULL, 1),
('Alpha-Z1', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 350000, NULL, NULL, 1),
('Alkonost', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 2200000, NULL, NULL, 1),
('Annihilator', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1200000, NULL, NULL, 1),
('Annihilator Stealth', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1650000, NULL, NULL, 1),
('Buzzard', (SELECT ID FROM marque WHERE Nom='Nagasaki'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 750000, NULL, NULL, 1),
('Cargobob', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 950000, NULL, NULL, 1),
('Cargobob2', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1050000, NULL, NULL, 1),
('Cargobob3', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 900000, NULL, NULL, 1),
('Cargobob4', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 950000, NULL, NULL, 1),
('Mallard', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 250000, NULL, NULL, 1),
('Duster', (SELECT ID FROM marque WHERE Nom='Western Company'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 190000, NULL, NULL, 1),
('Luxor', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1100000, NULL, NULL, 1),
('Luxor Deluxe', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 2800000, NULL, NULL, 1),
('Tula', (SELECT ID FROM marque WHERE Nom='Mammoth'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 1400000, NULL, NULL, 1),
('Skylift', (SELECT ID FROM marque WHERE Nom='HVY'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 600000, NULL, NULL, 1),
('Seasparrow', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 520000, NULL, NULL, 1),
('Seasparrow2', (SELECT ID FROM marque WHERE Nom='Buckingham'), (SELECT ID FROM categorie WHERE Libelle='Aircraft'), 600000, NULL, NULL, 1);



