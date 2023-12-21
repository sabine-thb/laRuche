
-- Thibout benjamin
-- Projet : Site LaRuche
-- collaborateurs: Maitre Arsene, Thibout Sabine
-- script création
-- test1.cah82lrh4zyj.eu-west-3.rds.amazonaws.com


-- CREATION

DROP DATABASE IF EXISTS LaRuche;
CREATE DATABASE LaRuche;
USE LaRuche;


CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    est_verifier BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE admin(
	admin_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	login VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE competition(
    competition_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description VARCHAR(1024),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pronostiqueur(
    pronostiqueur_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_id INT NOT NULL,
    competition_id INT NOT NULL,
    points INT DEFAULT 0,
    CONSTRAINT fk_pronostiqueur_users FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_pronostiqueur_competition FOREIGN KEY(competition_id) REFERENCES competition(competition_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE equipe(
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    srcLogo VARCHAR(50)
);

CREATE TABLE matchApronostiquer(
    match_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    equipe1_id INT NOT NULL,
    equipe2_id INT NOT NULL,
    competition_id INT NOT NULL,
    pts_Exact INT NOT NULL,
    pts_Ecart INT NOT NULL,
    pts_Vainq INT NOT NULL,
    date_max_pari DATE NOT NULL,
    CONSTRAINT fk_match_equipe1 FOREIGN KEY(equipe1_id) REFERENCES equipe(equipe_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_match_equipe2 FOREIGN KEY(equipe2_id) REFERENCES equipe(equipe_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_match_competition FOREIGN KEY(competition_id) REFERENCES competition(competition_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE resultatMatch(
    match_id INT NOT NULL PRIMARY KEY,
    nb_but_equipe1 INT,
    nb_but_equipe2 INT,
    CONSTRAINT fk_resultatMatch_match FOREIGN KEY(match_id) REFERENCES matchApronostiquer(match_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE pronostique(
    match_id INT NOT NULL,
    pronostiqueur_id INT NOT NULL,
    prono_equipe1 INT,
    prono_equipe1 INT,
    CONSTRAINT fk_resultatMatch_match FOREIGN KEY(match_id) REFERENCES matchApronostiquer(match_id) ON DELETE RESTRICT ON UPDATE CASCADE
);


-- Trigger

-- syntaxe :

-- delimiter |

-- CREATE TRIGGER testref BEFORE INSERT ON test1
--   FOR EACH ROW
--   BEGIN
--     INSERT INTO test2 SET a2 = NEW.a1;
--     DELETE FROM test3 WHERE a3 = NEW.a1;
--     UPDATE test4 SET b4 = b4 + 1 WHERE a4 = NEW.a1;
--   END;
-- |

-- CREATE TRIGGER ajoutAutoPronoDefaut BEFORE INSERT ON LaRuche.matchApronostiquer
-- FOR EACH ROW
-- BEGIN 

--     DECLARE nbPronostiqueur INT;

--     SELECT count(*) INTO nbPronostiqueur 
--     FROM LaRuche.pronostiqueur as P 
--     WHERE P.competition_id = NEW.competition_id;



-- delimiter ;

-- INSERTION DEFAUT

INSERT INTO admin(login,password) VALUES ('admin','$2y$10$NgQgoczV30jYL290isx3pOSP3eUfJaVsWpjQW8xz1ruhazMEVN7WO');

INSERT INTO competition(nom,description) VALUES
('test','supprime moi en cliquant sur la corbeille'),
('champions league','championnat des meilleurs club d europe');
