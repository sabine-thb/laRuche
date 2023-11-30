-------------------------------------
-- maitre arsene
-- Projet : Site La ruche
-- script creation
-- test1.cah82lrh4zyj.eu-west-3.rds.amazonaws.com
-------------------------------------

-------------------------------------
-- CREATION
-------------------------------------

DROP SCHEMA IF EXISTS LaRuche CASCADE;
DROP SCHEMA IF EXISTS Scorcast CASCADE;
CREATE SCHEMA LaRuche;
CREATE SCHEMA Scorcast;

SET search_path TO LaRuche;

CREATE TABLE users(
	user_id SERIAL NOT NULL ,
	login VARCHAR NOT NULL,
    mail VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    est_verifier BOOLEAN NOT NULL DEFAULT false,
	CONSTRAINT pk_user PRIMARY KEY(user_id)
);

CREATE TABLE admin(
	admin_id SERIAL NOT NULL ,
	login VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
	CONSTRAINT pk_admin PRIMARY KEY(admin_id),
);

-- SET search_path TO Scorcast;

-------------------------------------
-- INSERTION DEFAUT
-------------------------------------

SET search_path TO LaRuche;

INSERT INTO admin(login,password) values ('admin','$2y$10$NgQgoczV30jYL290isx3pOSP3eUfJaVsWpjQW8xz1ruhazMEVN7WO');
