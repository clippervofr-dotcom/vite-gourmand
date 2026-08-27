INSERT INTO role (libelle) VALUES ('Utilisateur');
INSERT INTO role (libelle) VALUES ('Employe');
INSERT INTO role (libelle) VALUES ('Admin');

INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (3, 'jojo@gmail.com', '$2b$10$Ssxf4wAoxoblQM0LfkgT6.zR4ldp/d/tG58n.KwL1mg.3x/8wLRZm', 'jojo', 'josé', '0633000777', '107 avenue du Dr Schinazi', 'Bordeaux', '33300');

INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (2, 'juju@gmail.com', '$2b$10$nsP0ROUkPnANl9cKB.pFTeLk4kZ5TATK8R/gdxYzjm/bip9wLTEYq', 'juju', 'julie', '0688888888', '107 avenue du Dr Schinazi', 'Bordeaux', '33300');

INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (1, 'djodjo@gmail.com', '$2b$10$HdC1jP7MMgpj/uUWVrrlh.wGi3g5hoMSDtTfCOH1Bq5s3gORrUWgi', 'djodjo', 'djo', '0633000999', '107 avenue du Dr Schinazi', 'Bordeaux', '33300');

INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (1, 'test@test.fr', '$2y$10$9lcVj4Msk5pikTlWbOY.5OKjdEkeNC3g2ru.hD3p03pwQk5tpUsjO', 'testNOM', 'testPRENOM', '0633000999', '6 Route de Monsidun', 'Houmeau', '17137');


INSERT INTO theme (libelle) VALUES ('Noël');
INSERT INTO theme (libelle) VALUES ('Pâques');
INSERT INTO theme (libelle) VALUES ('Classique');
INSERT INTO theme (libelle) VALUES ('Evénements');


INSERT INTO regime (libelle) VALUES ('Classique');
INSERT INTO regime (libelle) VALUES ('Végétarien');
INSERT INTO regime (libelle) VALUES ('Vegan');
INSERT INTO regime (libelle) VALUES ('Sans gluten');


INSERT INTO allergene (libelle) VALUES ('Oeufs');
INSERT INTO allergene (libelle) VALUES ('Poisson');
INSERT INTO allergene (libelle) VALUES ('Arachides');
INSERT INTO allergene (libelle) VALUES ('Lactose');
INSERT INTO allergene (libelle) VALUES ('Fruits à coque');
INSERT INTO allergene (libelle) VALUES ('Gluten');


INSERT INTO menu (titre, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, description_menu)
VALUES ('Menu de Noël', 10, 30.00, 'Veuillez reserver ce menu 1 semaine à l''avance', 50, 'Des saveurs si festives que même le Père Noël risque d''oublier sa tournée !');

INSERT INTO menu (titre, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, description_menu)
VALUES ('Menu de Pâques', 10, 25.00, 'Veuillez reserver ce menu 4 jours à l''avance', 25, 'Une chasse aux œufs, c''est bien. Une chasse aux bons plats, c''est mieux !');

INSERT INTO menu (titre, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, description_menu)
VALUES ('Menu Classique', 20, 20.00, 'Veuillez reserver ce menu 15 jours à l''avance', 30, 'Les grands classiques : parce qu''on ne change pas une équipe qui régale');

INSERT INTO menu (titre, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, description_menu)
VALUES ('Menu Evenementiels', 30, 50.00, 'Veuillez reserver ce menu 2 mois à l''avance', 100, 'Pour vos grands moments : on s''occupe du festin, vous récoltez les compliments');

INSERT INTO menu (titre, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, description_menu)
VALUES ('Menu Végétarien', 20, 5.00, 'Veuillez reserver ce menu 2 jours à l''avance', 100, 'La preuve qu''un repas peut être complet sans avoir rencontré une vache.');



INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Foie de la Fête', 'entrée', 'Foie gras raffiné, chutney et brioche grillée.', '../assets/images/noel-entree-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Velouté du Père Gourmand', 'entrée', 'Velouté crémeux aux herbes et croûtons dorés.', '../assets/images/noel-entree-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Dinde qui Fait l''Unanimité', 'plat', 'Rôti de volaille aux canneberges et romarin.', '../assets/images/noel-plat-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Festin des Lutins Gourmets', 'plat', 'Gourmet d’automne aux accents forestiers.', '../assets/images/noel-plat-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Bûche qui Fait Craquer', 'dessert', 'Bûche chocolat-noisettes festive.', '../assets/images/noel-dessert-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Forêt des Mille Flocons', 'dessert', 'Dessert hivernal aux flocons de neige.', '../assets/images/noel-dessert-2.png');



INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Jardin des Lapins Fins Gourmets', 'entrée', 'Jardin de légumes aux petits lapins.', '../assets/images/paques-entree-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('L''Œuf-Corieux du Printemps', 'entrée', 'Salade printanière à l’œuf gourmand.', '../assets/images/paques-entree-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('L''Agneau Pas Comme les Autres', 'plat', 'Carré d’agneau rôti aux légumes gourmands.', '../assets/images/paques-plat-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Retour du Lapin Malin', 'plat', 'Lapin rôti aux légumes rustiques.', '../assets/images/paques-plat-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Nid Tout Chocolat', 'dessert', 'Nid de chocolat aux œufs gourmands.', '../assets/images/paques-dessert-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Cloche Gourmande', 'dessert', 'Dessert gourmand sous cloche dorée.', '../assets/images/paques-dessert-2.png');



INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Grand Incontournable', 'entrée', 'Plate apéritive gourmande aux couleurs éclatantes.', '../assets/images/classique-entree-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Plaisir Sans Détour', 'entrée', 'Festin doré de bouchées gourmandes.', '../assets/images/classique-entree-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Poulet qui Fait Maison', 'plat', 'Poulet rôti aux légumes et pommes de terre.', '../assets/images/classique-plat-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Bœuf Bien Élevé', 'plat', 'Bœuf rôti tranché, garnitures rustiques.', '../assets/images/classique-plat-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Douce Fin', 'dessert', 'Dessert chocolaté gourmand aux fruits rouges.', '../assets/images/classique-dessert-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Petit Péché Mignon', 'dessert', 'Délice chocolaté gourmand aux éclats croquants.', '../assets/images/classique-dessert-2.png');



INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Première Standing Ovation', 'entrée', 'Cylindre doré au caviar et œufs de saumon.', '../assets/images/evenement-entree-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Prestige en Assiette', 'entrée', 'Élégant médaillon de fruits de mer et caviar.', '../assets/images/evenement-entree-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Royal Gourmand', 'plat', 'Steak sauce au poivre et garnitures rustiques.', '../assets/images/evenement-plat-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Star du Buffet', 'plat', 'Rôti de bœuf gourmand aux légumes rôtis.', '../assets/images/evenement-plat-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Bouquet Final', 'dessert', 'Dessert chocolat caramel aux éclats dorés.', '../assets/images/evenement-dessert-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Gâteau des Applaudissements', 'dessert', 'Gâteau chocolaté festif aux couches gourmandes.', '../assets/images/evenement-dessert-2.png');



INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Panier du Maraîcher Heureux', 'entrée', 'Panier rustique de légumes colorés et dips.', '../assets/images/vegetarien-entree-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Les Saveurs du Verger', 'entrée', 'Salade gourmande aux fruits et chèvre grillé.', '../assets/images/vegetarien-entree-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Gratin du Potager', 'plat', 'Gratin de légumes doré aux herbes.', '../assets/images/vegetarien-plat-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Délice Vert', 'plat', 'Bol de riz vert aux légumes grillés.', '../assets/images/vegetarien-plat-2.png');

INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('Le Verger Gourmand', 'dessert', 'Tour fruité gourmand aux fleurs fraîches.', '../assets/images/vegetarien-dessert-1.png');
INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES ('La Douceur des Saisons', 'dessert', 'Dessert rustique aux fruits et fleurs édibles.', '../assets/images/vegetarien-dessert-2.png');


INSERT INTO menu_regime (menu_id, regime_id) VALUES (1, 1);
INSERT INTO menu_regime (menu_id, regime_id) VALUES (2, 1);
INSERT INTO menu_regime (menu_id, regime_id) VALUES (3, 1);
INSERT INTO menu_regime (menu_id, regime_id) VALUES (4, 1);
INSERT INTO menu_regime (menu_id, regime_id) VALUES (5, 2);
INSERT INTO menu_regime (menu_id, regime_id) VALUES (5, 3);

INSERT INTO menu_theme (menu_id, theme_id) VALUES (1, 1);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (1, 4);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (2, 2);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (2, 4);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (3, 3);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (4, 4);
INSERT INTO menu_theme (menu_id, theme_id) VALUES (5, 3);

INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 1);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 2);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 3);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 4);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 5);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (1, 6);

INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 7);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 8);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 9);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 10);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 11);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (2, 12);

INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 13);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 14);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 15);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 16);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 17);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (3, 18);

INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 19);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 20);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 21);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 22);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 23);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (4, 24);

INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 25);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 26);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 27);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 28);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 29);
INSERT INTO menu_plat (menu_id, plat_id) VALUES (5, 30);

INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (2, 4);
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (5, 4);
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (8, 1);
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (25, 5);
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (22, 2);
INSERT INTO plat_allergene (plat_id, allergene_id) VALUES (12, 3);

INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Lundi', '09:00', '18:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Mardi', '09:00', '18:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Mercredi', '09:00', '18:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Jeudi', '09:00', '18:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Vendredi', '09:00', '18:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Samedi', '09:00', '13:00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Dimanche', NULL, NULL);

INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-343', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-320', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'validée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-310', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'annulée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-200', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 2, 'COMMANDE-210', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 3, 'COMMANDE-220', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-230', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 5, 'COMMANDE-240', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-250', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 2, 'COMMANDE-260', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 3, 'COMMANDE-270', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-280', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-290', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'annulée');

INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-100', '2026-01-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 100.00, 'validée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-101', '2026-02-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 200.00, 'annulée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-102', '2026-03-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 300.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 2, 'COMMANDE-103', '2026-04-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 400.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 3, 'COMMANDE-104', '2026-05-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 500.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-105', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 600.00, 'terminée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 5, 'COMMANDE-106', '2026-07-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 700.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-107', '2026-08-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 800.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 2, 'COMMANDE-108', '2026-09-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 900.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 3, 'COMMANDE-109', '2026-10-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 1000.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-110', '2026-11-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 1100.00, 'en attente');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-111', '2026-12-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 1200.00, 'annulée');
INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 4, 'COMMANDE-112', '2025-12-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 100.00, 'annulée');

INSERT INTO historique_statut (commande_id, statut, date_changement)
VALUES (1, 'en attente', '2026-06-25 12:00:00');
INSERT INTO historique_statut (commande_id, statut, date_changement)
VALUES (2, 'validée', '2026-05-25 12:00:00');
INSERT INTO historique_statut (commande_id, statut, date_changement)
VALUES (3, 'annulée', '2026-04-25 12:00:00');

INSERT INTO image_menu (menu_id, url) VALUES (1, '../assets/images/noel1.png');
INSERT INTO image_menu (menu_id, url) VALUES (2, '../assets/images/paques1.png');
INSERT INTO image_menu (menu_id, url) VALUES (3, '../assets/images/classique1.png');
INSERT INTO image_menu (menu_id, url) VALUES (4, '../assets/images/evenement.png');
INSERT INTO image_menu (menu_id, url) VALUES (5, '../assets/images/vegetarien.png');



