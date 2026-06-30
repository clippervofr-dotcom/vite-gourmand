INSERT INTO role (libelle) VALUES ('Utilisateur');
INSERT INTO role (libelle) VALUES ('Employe');
INSERT INTO role (libelle) VALUES ('Admin');

INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (3, 'jojo@gmail.com', 'jojolafrite', 'jojo', 'josé', '0633000777', '1 rue de jose', 'Bordeaux', '33000');


INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (2, 'juju@gmail.com', 'jujulatomate', 'juju', 'julie', '0688888888', '1 rue de julie', 'Bordeaux', '33000');


INSERT INTO utilisateur (role_id, email, password, nom, prenom, telephone, adresse, ville, code_postal)
VALUES (1, 'djodjo@gmail.com', 'djodjolekiwi', 'djodjo', 'djo', '0633000999', '1 rue de djo', 'Bordeaux', '33000');


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



INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Foie de la Fête', 'entrée', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Velouté du Père Gourmand', 'entrée', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('La Dinde qui Fait l''Unanimité', 'plat', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Festin des Lutins Gourmets', 'plat', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('La Bûche qui Fait Craquer', 'dessert', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('La Forêt des Mille Flocons', 'dessert', NULL);



INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Jardin des Lapins Fins Gourmets', 'entrée', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('L''Œuf-Corieux du Printemps', 'entrée', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('L''Agneau Pas Comme les Autres', 'plat', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Retour du Lapin Malin', 'plat', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Nid Tout Chocolat', 'dessert', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('La Cloche Gourmande', 'dessert', NULL);



INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Grand Incontournable', 'entrée', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Plaisir Sans Détour', 'entrée', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Poulet qui Fait Maison', 'plat', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Bœuf Bien Élevé', 'plat', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('La Douce Fin', 'dessert', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Petit Péché Mignon', 'dessert', NULL);



INSERT INTO plat (nom, type_plat, photo) VALUES ('La Première Standing Ovation', 'entrée', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Prestige en Assiette', 'entrée', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Royal Gourmand', 'plat', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('La Star du Buffet', 'plat', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Bouquet Final', 'dessert', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Gâteau des Applaudissements', 'dessert', NULL);



INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Panier du Maraîcher Heureux', 'entrée', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Les Saveurs du Verger', 'entrée', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Gratin du Potager', 'plat', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Délice Vert', 'plat', NULL);

INSERT INTO plat (nom, type_plat, photo) VALUES ('Le Verger Gourmand', 'dessert', NULL);
INSERT INTO plat (nom, type_plat, photo) VALUES ('La Douceur des Saisons', 'dessert', NULL);




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


INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Lundi', '9h00', '18h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Mardi', '9h00', '18h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Mercredi', '9h00', '18h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Jeudi', '9h00', '18h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Vendredi', '9h00', '18h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Samedi', '9h00', '12h00');
INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES ('Dimanche', NULL, NULL);


INSERT INTO commande (utilisateur_id, menu_id, numero_commande, date_commande, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut)
VALUES (3, 1, 'COMMANDE-343', '2026-06-25 12:00:00', '2026-07-13', '19:00', '26 rue du potager, 33000 Bordeaux', 20, 600.00, 5.00, 605.00, 'en attente');


INSERT INTO historique_statut (commande_id, statut, date_changement) 
VALUES (1, 'en attente', '2026-06-25 12:00:00');


INSERT INTO avis (utilisateur_id, commande_id, note, description_avis, statut)
VALUES (3, 1, 5, 'Excellent! Nous avons passez un agréable moment!', 'validé');






