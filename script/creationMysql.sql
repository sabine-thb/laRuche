
-- Thibout benjamin
-- Projet : Site LaRuche
-- collaborateurs: Maitre Arsene, Thibout Sabine
-- script création
-- test1.cah82lrh4zyj.eu-west-3.rds.amazonaws.com
-- source creationMysql.sql


-- CREATION

DROP DATABASE IF EXISTS LaRuche;
CREATE DATABASE LaRuche;
USE LaRuche;


CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    description VARCHAR(500),
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
    date_creation DATE
);

CREATE TABLE pronostiqueur(
    pronostiqueur_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_id INT NOT NULL,
    competition_id INT NOT NULL,
#     points INT DEFAULT 0,
    CONSTRAINT fk_pronostiqueur_users FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_pronostiqueur_competition FOREIGN KEY(competition_id) REFERENCES competition(competition_id) ON DELETE CASCADE ON UPDATE CASCADE
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
    pts_Exact INT NOT NULL DEFAULT 0,
    pts_Ecart INT NOT NULL DEFAULT 0,
    pts_Vainq INT NOT NULL DEFAULT 0,
    date_match DATE NOT NULL,
    pari_ouvert BOOLEAN NOT NULL DEFAULT true,
    CONSTRAINT fk_match_equipe1 FOREIGN KEY(equipe1_id) REFERENCES equipe(equipe_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_match_equipe2 FOREIGN KEY(equipe2_id) REFERENCES equipe(equipe_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_match_competition FOREIGN KEY(competition_id) REFERENCES competition(competition_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE resultatMatch(
    match_id INT NOT NULL PRIMARY KEY,
    nb_but_equipe1 INT,
    nb_but_equipe2 INT,
    resultat_peno ENUM('equipe1','equipe2'),
    CONSTRAINT fk_resultatMatch_match FOREIGN KEY(match_id) REFERENCES matchApronostiquer(match_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pronostique(
    match_id INT NOT NULL,
    pronostiqueur_id INT NOT NULL,
    prono_equipe1 INT,
    prono_equipe2 INT,
    point_obtenu INT DEFAULT 0,
    vainqueur_prono ENUM('equipe1','equipe2'),
    CONSTRAINT fk_pronostique_pronostiqueur FOREIGN KEY(pronostiqueur_id) REFERENCES pronostiqueur(pronostiqueur_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_pronostique_match FOREIGN KEY(match_id) REFERENCES matchApronostiquer(match_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Fonction

delimiter $$

DROP FUNCTION IF EXISTS LaRuche.bonVaiqueur $$
CREATE FUNCTION LaRuche.bonVaiqueur(
    prono1 INT, prono2 INT, pronoVainqueurPeno ENUM('equipe1','equipe2'),
    resultat1 INT, resultat2 INT, pesultatVainqueurPeno ENUM('equipe1','equipe2')
) RETURNS BOOLEAN
BEGIN
    DECLARE result BOOLEAN;

    IF (prono1 - prono2) = 0 and (resultat1 - resultat2) = 0 THEN -- egalité, ne devrait pas arrivé apriori
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno IS NOT NULL and pronoVainqueurPeno = pesultatVainqueurPeno THEN
        SET result = TRUE;
    ELSEIF prono1 > prono2 and resultat1 > resultat2 THEN -- equipe1 win
        SET result = TRUE;
    ELSEIF prono1 < prono2 and resultat1 < resultat2 THEN -- equipe2 win
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno = 'equipe1' and resultat1 > resultat2 THEN
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno = 'equipe2' and resultat2 > resultat1 THEN
        SET result = TRUE;
    ELSE
        SET result = FALSE;
    END IF;

    RETURN result;
END $$

DROP FUNCTION IF EXISTS LaRuche.totalPoint $$
CREATE FUNCTION LaRuche.totalPoint(id_pronostiqueur INT, id_compet INT) RETURNS INT
BEGIN

    DECLARE t INT;

    SELECT SUM(point_obtenu) INTO t
                             FROM LaRuche.pronostique
                             NATURAL JOIN LaRuche.matchApronostiquer
                             WHERE pronostiqueur_id = id_pronostiqueur and competition_id = id_compet;

    IF t IS NULL THEN
        SET t = 0;
    END IF;

    RETURN t;
END $$

-- Trigger

-- ajoute automatiquement des tuples de pronostique pour chaque personne d'une competition lorsqu'un match est crée

DROP TRIGGER IF EXISTS LaRuche.ajoutAutoPronoDefaut $$
CREATE TRIGGER LaRuche.ajoutAutoPronoDefaut AFTER INSERT ON LaRuche.matchApronostiquer
    FOR EACH ROW
BEGIN 

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE myCursor CURSOR FOR SELECT pronostiqueur_id FROM LaRuche.pronostiqueur;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;
        
        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.pronostique(match_id,pronostiqueur_id) VALUES (NEW.match_id,idTemp);
    END LOOP;

    CLOSE myCursor;
END $$

-- ajoute automatiquement des prono au matchs créé précédemment si un user rejoint une competition en cours de route

DROP TRIGGER IF EXISTS LaRuche.ajoutAutoPronoBefore $$
CREATE TRIGGER LaRuche.ajoutAutoPronoBefore AFTER INSERT ON LaRuche.pronostiqueur
    FOR EACH ROW
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE myCursor CURSOR FOR SELECT match_id FROM LaRuche.matchApronostiquer WHERE competition_id = NEW.competition_id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.pronostique(match_id,pronostiqueur_id) VALUES (idTemp,NEW.pronostiqueur_id);
    END LOOP;

    CLOSE myCursor;
END $$

-- permet d'ajouter les points au pronostiqueurs lors qu'un resultat est enregistrer

DROP TRIGGER IF EXISTS LaRuche.calculsPoints $$
CREATE TRIGGER LaRuche.calculsPoints AFTER INSERT ON LaRuche.resultatMatch
    FOR EACH ROW
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE prono1 INT;
    DECLARE prono2 INT;
    DECLARE pronoResultatPeno ENUM('equipe1','equipe2');
    DECLARE ptTemp INT;
    DECLARE myCursor CURSOR FOR
        SELECT pronostiqueur_id
        FROM LaRuche.pronostiqueur
        WHERE competition_id = (SELECT competition_id
                                FROM LaRuche.resultatMatch
                                NATURAL JOIN LaRuche.matchApronostiquer
                                WHERE match_id = NEW.match_id
                                )
    ;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        SELECT prono_equipe1,prono_equipe2,vainqueur_prono
        INTO prono1, prono2,pronoResultatPeno
        FROM LaRuche.pronostique
        WHERE pronostiqueur_id = idTemp and pronostique.match_id = NEW.match_id;

        IF prono1 = prono2 and NEW.nb_but_equipe1 = NEW.nb_but_equipe2 THEN
            IF prono1 = NEW.nb_but_equipe1 THEN
                IF pronoResultatPeno = NEW.resultat_peno THEN
                    SET ptTemp = (SELECT pts_Exact FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
                ELSE
                    SET ptTemp = (SELECT (pts_Exact - pts_Vainq) FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
                END IF;
            ELSE
                IF pronoResultatPeno = NEW.resultat_peno THEN
                    SET ptTemp = (SELECT pts_Ecart FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
                ELSE
                    SET ptTemp = (SELECT (pts_Ecart - pts_Vainq) FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
                END IF;
            END IF;
        ELSEIF prono1 = NEW.nb_but_equipe1 and prono2 = NEW.nb_but_equipe2 THEN
            SET ptTemp = (SELECT pts_Exact FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
        ELSEIF bonVaiqueur(prono1,prono2,pronoResultatPeno,NEW.nb_but_equipe1,NEW.nb_but_equipe2,NEW.resultat_peno) THEN
            IF ABS(prono1 - prono2) = ABS(NEW.nb_but_equipe1 - NEW.nb_but_equipe2) THEN
                SET ptTemp = (SELECT pts_Ecart FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
            ELSE
                SET ptTemp = (SELECT pts_Vainq FROM LaRuche.matchApronostiquer WHERE match_id = NEW.match_id);
            END IF;
        ELSE
            SET ptTemp = 0;
        END IF;

        UPDATE LaRuche.pronostique SET point_obtenu = ptTemp WHERE pronostiqueur_id = idTemp and pronostique.match_id = NEW.match_id;

    END LOOP;

    CLOSE myCursor;
END $$


delimiter ;

-- INSERTION DEFAUT

INSERT INTO admin(login,password) VALUES ('admin','$2y$10$NgQgoczV30jYL290isx3pOSP3eUfJaVsWpjQW8xz1ruhazMEVN7WO');

INSERT INTO competition(nom,description,date_creation) VALUES
('test','supprime moi en cliquant sur la corbeille',CURRENT_DATE()),
('champions league','championnat des meilleurs club d europe',CURRENT_DATE());
