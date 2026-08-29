CREATE TABLE role (
  role_id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(50) NOT NULL
);

CREATE TABLE utilisateur (
  utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nom VARCHAR(50),
  prenom VARCHAR(50),
  telephone VARCHAR(20),
  adresse VARCHAR(150),
  ville VARCHAR(50),
  code_postal VARCHAR(10),
  actif BOOL DEFAULT TRUE,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES role(role_id)
);

CREATE TABLE menu (
  menu_id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(100) NOT NULL,
  description_menu VARCHAR(500) NOT NULL,
  nombre_personne_minimum INT NOT NULL,
  prix_par_personne  DECIMAL(10,2) NOT NULL,
  conditions VARCHAR(500) NOT NULL,
  quantite_restante INT,
  actif BOOL DEFAULT TRUE
);

CREATE TABLE theme (
  theme_id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(50) NOT NULL
);

CREATE TABLE regime (
  regime_id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(50) NOT NULL
);

CREATE TABLE menu_theme (
  menu_id INT,
  theme_id INT,
  PRIMARY KEY (menu_id, theme_id),
  FOREIGN KEY (menu_id) REFERENCES menu(menu_id),
  FOREIGN KEY (theme_id) REFERENCES theme(theme_id)
);

CREATE TABLE menu_regime (
  menu_id INT,
  regime_id INT,
  PRIMARY KEY (menu_id, regime_id),
  FOREIGN KEY (menu_id) REFERENCES menu(menu_id),
  FOREIGN KEY (regime_id) REFERENCES regime(regime_id)
);

CREATE TABLE plat (
  plat_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  type_plat VARCHAR(20) NOT NULL,
  description_plat VARCHAR(500) NOT NULL,
  photo VARCHAR(255)
);

CREATE TABLE allergene (
  allergene_id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(50) NOT NULL
);

CREATE TABLE plat_allergene (
  plat_id INT,
  allergene_id INT,
  PRIMARY KEY (plat_id, allergene_id),
  FOREIGN KEY (plat_id) REFERENCES plat(plat_id),
  FOREIGN KEY (allergene_id) REFERENCES allergene(allergene_id)
);

CREATE TABLE menu_plat (
  menu_id INT,
  plat_id INT,
  PRIMARY KEY (menu_id, plat_id),
  FOREIGN KEY (menu_id) REFERENCES menu(menu_id),
  FOREIGN KEY (plat_id) REFERENCES plat(plat_id)
);

CREATE TABLE image_menu (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  menu_id INT NOT NULL,
  url VARCHAR(255) NOT NULL,
  FOREIGN KEY (menu_id) REFERENCES menu(menu_id)
);

CREATE TABLE commande (
  commande_id INT AUTO_INCREMENT PRIMARY KEY,
  numero_commande VARCHAR(50) UNIQUE,
  utilisateur_id INT NOT NULL,
  menu_id INT NOT NULL,
  date_commande DATETIME DEFAULT NOW(),
  date_prestation DATE NOT NULL,
  heure_prestation VARCHAR(10),
  adresse_livraison VARCHAR(200),
  nombre_personnes INT NOT NULL,
  prix_menu DECIMAL(10,2),
  prix_livraison DECIMAL(10,2),
  prix_total DECIMAL(10,2),
  statut VARCHAR(50) DEFAULT 'en attente',
  motif_annulation VARCHAR(500) NULL,
  mode_contact_annulation VARCHAR(50),
  pret_materiel BOOL DEFAULT FALSE,
  rendu_materiel BOOL DEFAULT FALSE,
  possede_avis BOOL DEFAULT FALSE,
  FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(utilisateur_id),
  FOREIGN KEY (menu_id) REFERENCES menu(menu_id)
);

CREATE TABLE historique_statut (
  historique_id INT AUTO_INCREMENT PRIMARY KEY,
  commande_id INT NOT NULL,
  statut VARCHAR(50) NOT NULL,
  date_changement DATETIME DEFAULT NOW(),
  FOREIGN KEY (commande_id) REFERENCES commande(commande_id)
);

CREATE TABLE horaire (
  horaire_id INT AUTO_INCREMENT PRIMARY KEY,
  jour VARCHAR(20) NOT NULL,
  heure_ouverture VARCHAR(10),
  heure_fermeture VARCHAR(10)
);
