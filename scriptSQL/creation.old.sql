-------------------------------------
-- maitre arsene
-- Projet : Site La ruche
-- ancien script pour postgresSQL
-------------------------------------

-------------------------------------
-- CREATION
-------------------------------------

DROP SCHEMA IF EXISTS LaRuche CASCADE;
DROP SCHEMA IF EXISTS Scorcast CASCADE;
CREATE SCHEMA LaRuche;
CREATE SCHEMA Scorcast;

SET search_path TO LaRuche;

CREATE TABLE users
(
    user_id  SERIAL  NOT NULL,
    login    VARCHAR NOT NULL,
    mail     VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    est_verifier BOOLEAN NOT NULL DEFAULT false,
    CONSTRAINT pk_user PRIMARY KEY (user_id)
);

CREATE TABLE admin
(
    admin_id SERIAL  NOT NULL,
    login    VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    CONSTRAINT pk_admin PRIMARY KEY (admin_id)
);

SET search_path TO Scorcast;

CREATE TABLE competition
(
    competition_id SERIAL  NOT NULL,
    nom            VARCHAR NOT NULL,
    description    VARCHAR,
    date_creation  DATE DEFAULT CURRENT_DATE,
    CONSTRAINT pk_competition PRIMARY KEY (competition_id)
);

-------------------------------------
-- INSERTION DEFAUT
-------------------------------------

SET search_path TO LaRuche;

INSERT INTO admin(login, password)
values ('admin', '$2y$10$NgQgoczV30jYL290isx3pOSP3eUfJaVsWpjQW8xz1ruhazMEVN7WO');

SET search_path TO Scorcast;

INSERT INTO competition(nom, description)
values ('test', 'supprime moi en cliquant sur la corbeille'),
       ('champions league', 'championnat des meilleurs club d europe');
