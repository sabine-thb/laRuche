-------------------------------------
-- maitre arsene
-- tp 05
-- script creation
-- psql -h database-etudiants -d amaitre
-------------------------------------

DROP SCHEMA IF EXISTS commandes CASCADE;
CREATE SCHEMA commandes;
SET search_path TO garageCentral;

CREATE TABLE commandes.marque(
	mar_id SERIAL NOT NULL ,
	mar_nom VARCHAR NOT NULL,
	CONSTRAINT pk_marque PRIMARY KEY(mar_id)
);

CREATE TABLE commandes.client(
	cli_id SERIAL NOT NULL,
	cli_nom VARCHAR NOT NULL,
	cli_prenom VARCHAR,
	CONSTRAINT pk_client PRIMARY KEY(cli_id)
);

CREATE TABLE commandes.commande(
	cmd_id SERIAL NOT NULL,
	cmd_date DATE NOT NULL,
	cli_id INT NOT NULL,
	CONSTRAINT pk_commande PRIMARY KEY(cmd_id),
	CONSTRAINT fk_commande_client FOREIGN KEY(cli_id) REFERENCES commandes.client(cli_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE commandes.produit(
	pdt_id SERIAL NOT NULL,
	pdt_libelle VARCHAR NOT NULL,
	pdt_prix DECIMAL(6,2) NOT NULL CHECK (pdt_prix < 10000),
	mar_id INT,
	CONSTRAINT pk_produit PRIMARY KEY(pdt_id),
	CONSTRAINT fk_produit_marque FOREIGN KEY(mar_id) REFERENCES commandes.marque(mar_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE commandes.ligne(
	cmd_id INT NOT NULL,
	lig_numero SERIAL NOT NULL CHECK (lig_numero > 0),
	lig_quantite INT NOT NULL CHECK (lig_quantite > 0),
	pdt_id INT NOT NULL,
	CONSTRAINT pk_ligne PRIMARY KEY(cmd_id,lig_numero),
	CONSTRAINT fk_ligne_commande FOREIGN KEY(cmd_id) REFERENCES commandes.commande(cmd_id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_ligne_produit FOREIGN KEY(pdt_id) REFERENCES commandes.produit(pdt_id) ON DELETE RESTRICT ON UPDATE CASCADE
);
