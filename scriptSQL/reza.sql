-- we don't know how to generate root <with-no-name> (class Root) :(

grant select on performance_schema.* to 'mysql.session'@localhost;

grant trigger on sys.* to 'mysql.sys'@localhost;

grant alter, alter routine, create, create routine, create temporary tables, create user, create view, delete, drop, event, execute, index, insert, lock tables, process, references, reload, replication client, replication slave, select, show databases, show view, trigger, update, grant option on *.* to admin;

grant audit_abort_exempt, firewall_exempt, select, system_user on *.* to 'mysql.infoschema'@localhost;

grant audit_abort_exempt, authentication_policy_admin, backup_admin, clone_admin, connection_admin, firewall_exempt, persist_ro_variables_admin, session_variables_admin, system_user, system_variables_admin on *.* to 'mysql.session'@localhost;

grant audit_abort_exempt, firewall_exempt, system_user on *.* to 'mysql.sys'@localhost;

grant alter, alter routine, application_password_admin, audit_abort_exempt, audit_admin, authentication_policy_admin, backup_admin, binlog_admin, binlog_encryption_admin, clone_admin, connection_admin, create, create role, create routine, create tablespace, create temporary tables, create user, create view, delete, drop, drop role, encryption_key_admin, event, execute, file, firewall_exempt, flush_optimizer_costs, flush_status, flush_tables, flush_user_resources, group_replication_admin, group_replication_stream, index, innodb_redo_log_archive, innodb_redo_log_enable, insert, lock tables, passwordless_user_admin, persist_ro_variables_admin, process, references, reload, replication client, replication slave, replication_applier, replication_slave_admin, resource_group_admin, resource_group_user, role_admin, select, sensitive_variables_observer, service_connection_admin, session_variables_admin, set_user_id, show databases, show view, show_routine, shutdown, super, system_user, system_variables_admin, table_encryption_admin, trigger, update, xa_recover_admin, grant option on *.* to rdsadmin@localhost;

create table LaRuche_users
(
    user_id       int auto_increment
        primary key,
    login         varchar(50)                                               not null,
    mail          varchar(50)                                               not null,
    description   varchar(500)                                              null,
    password      varchar(255)                                              not null,
    est_verifier  tinyint(1)  default 0                                     not null,
    src_logo_user varchar(50) default './style/img/users/defaut_profil.png' null,
    age           int                                                       null,
    Gender        varchar(15) default ''                                    not null,
    prenom        varchar(25) default ''                                    not null
);

create index index_user_user_id
    on LaRuche_users (user_id);

create table admin
(
    admin_id int auto_increment
        primary key,
    login    varchar(50)  not null,
    password varchar(255) not null
);

create table competition
(
    competition_id int auto_increment
        primary key,
    nom            varchar(50)   not null,
    description    varchar(1024) null,
    date_creation  date          null
);

create index index_competition_id
    on competition (competition_id);

create table equipe
(
    equipe_id int auto_increment
        primary key,
    nom       varchar(50) not null,
    srcLogo   varchar(50) null
);

create table matchApronostiquer
(
    match_id       int auto_increment
        primary key,
    equipe1_id     int                  not null,
    equipe2_id     int                  not null,
    competition_id int                  not null,
    pts_Exact      int        default 0 not null,
    pts_Ecart      int        default 0 not null,
    pts_Vainq      int        default 0 not null,
    date_match     date                 not null,
    pari_ouvert    tinyint(1) default 1 not null,
    heure          int                  not null,
    constraint fk_match_competition
        foreign key (competition_id) references competition (competition_id)
            on update cascade on delete cascade,
    constraint fk_match_equipe1
        foreign key (equipe1_id) references equipe (equipe_id)
            on update cascade,
    constraint fk_match_equipe2
        foreign key (equipe2_id) references equipe (equipe_id)
            on update cascade
);

create index index_match_competition_id
    on matchApronostiquer (competition_id);

create index index_match_match_id
    on matchApronostiquer (match_id);

create definer = admin@`%` trigger ajoutAutoPronoDefaut
    after insert
    on matchApronostiquer
    for each row
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE myCursor CURSOR FOR SELECT pronostiqueur_id FROM LaRuche.LaRuche_pronostiqueur WHERE LaRuche_pronostiqueur.competition_id = NEW.competition_id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.LaRuche_pronostique(match_id,pronostiqueur_id) VALUES (NEW.match_id,idTemp);
    END LOOP;

    CLOSE myCursor;
END;

create table pronostiqueur
(
    pronostiqueur_id int auto_increment
        primary key,
    user_id          int           not null,
    competition_id   int           not null,
    total_point      int default 0 not null comment 'test pour opti le classement',
    constraint fk_pronostiqueur_competition
        foreign key (competition_id) references competition (competition_id)
            on update cascade on delete cascade,
    constraint fk_pronostiqueur_users
        foreign key (user_id) references LaRuche_users (user_id)
            on update cascade on delete cascade
);

create table pronostique
(
    match_id         int                         not null,
    pronostiqueur_id int                         not null,
    prono_equipe1    int                         null,
    prono_equipe2    int                         null,
    point_obtenu     int default 0               null,
    vainqueur_prono  enum ('equipe1', 'equipe2') null,
    constraint fk_pronostique_match
        foreign key (match_id) references matchApronostiquer (match_id)
            on update cascade on delete cascade,
    constraint fk_pronostique_pronostiqueur
        foreign key (pronostiqueur_id) references pronostiqueur (pronostiqueur_id)
            on update cascade on delete cascade
);

create index index_pronostique_match_id
    on pronostique (match_id);

create index index_pronostique_poronostiqueur_id
    on pronostique (pronostiqueur_id);

create index index_pronostique_pronostiqueur_id
    on pronostiqueur (competition_id);

create index index_pronostiqueur_competition_id
    on pronostiqueur (pronostiqueur_id);

create index index_pronostiqueur_user_id
    on pronostiqueur (user_id);

create definer = admin@`%` trigger ajoutAutoPronoBefore
    after insert
    on pronostiqueur
    for each row
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE myCursor CURSOR FOR SELECT match_id FROM LaRuche.LaRuche_matchApronostiquer WHERE competition_id = NEW.competition_id;
    DECLARE myCursor2 CURSOR FOR SELECT question_bonus_id FROM LaRuche.LaRuche_questionBonus WHERE competition_id = NEW.competition_id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.LaRuche_pronostique(match_id,pronostiqueur_id) VALUES (idTemp,NEW.pronostiqueur_id);
    END LOOP;

    CLOSE myCursor;

    SET is_done = 0;

    OPEN myCursor2;

    read_loop: LOOP
        FETCH myCursor2 INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.LaRuche_pronoQuestionBonus(question_bonus_id,pronostiqueur_id) VALUES (idTemp,NEW.pronostiqueur_id);
    END LOOP;

    CLOSE myCursor2;

END;

create table questionBonus
(
    question_bonus_id   int auto_increment
        primary key,
    titre               varchar(50)                                 not null,
    competition_id      int                                         not null,
    objectif            varchar(150)                                null,
    type                enum ('nombre', 'string', 'equipe', 'bool') not null,
    point_bonne_reponse int                                         null,
    pari_ouvert         tinyint(1) default 1                        not null comment 'si le pronostiqueur peux encore parier sur le match',
    constraint fk_questionBonus_competition
        foreign key (competition_id) references competition (competition_id)
            on update cascade on delete cascade
);

create table pronoQuestionBonus
(
    question_bonus_id int           not null,
    pronostiqueur_id  int           not null,
    reponse           varchar(20)   null,
    point_obtenu      int default 0 null,
    constraint fk_pronoQuestionBonus_match
        foreign key (question_bonus_id) references questionBonus (question_bonus_id)
            on update cascade on delete cascade,
    constraint fk_pronoQuestionBonus_pronostiqueur
        foreign key (pronostiqueur_id) references pronostiqueur (pronostiqueur_id)
            on update cascade on delete cascade
);

create definer = admin@`%` trigger ajoutAutoPronoQuestionDefaut
    after insert
    on questionBonus
    for each row
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE myCursor CURSOR FOR SELECT pronostiqueur_id FROM LaRuche.LaRuche_pronostiqueur WHERE LaRuche_pronostiqueur.competition_id = NEW.competition_id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO LaRuche.LaRuche_pronoQuestionBonus(question_bonus_id,pronostiqueur_id) VALUES (NEW.question_bonus_id,idTemp);
    END LOOP;

    CLOSE myCursor;
END;

create table resultatMatch
(
    match_id       int                         not null
        primary key,
    nb_but_equipe1 int                         null,
    nb_but_equipe2 int                         null,
    resultat_peno  enum ('equipe1', 'equipe2') null,
    constraint fk_resultatMatch_match
        foreign key (match_id) references matchApronostiquer (match_id)
            on update cascade on delete cascade
);

create definer = admin@`%` trigger calculsPoints
    after insert
    on resultatMatch
    for each row
BEGIN

    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE idCompet INT;
    DECLARE prono1 INT;
    DECLARE prono2 INT;
    DECLARE pronoResultatPeno ENUM('equipe1','equipe2');
    DECLARE ptTemp INT;
    DECLARE myCursor CURSOR FOR
        SELECT pronostiqueur_id
        FROM LaRuche.LaRuche_pronostiqueur
        WHERE competition_id = (SELECT competition_id
                                FROM LaRuche.LaRuche_resultatMatch
                                         NATURAL JOIN LaRuche.LaRuche_matchApronostiquer
                                WHERE match_id = NEW.match_id
        )
    ;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    SELECT M.competition_id INTO idCompet FROM matchApronostiquer M WHERE M.match_id = NEW.match_id;

    OPEN myCursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        SELECT prono_equipe1,prono_equipe2,vainqueur_prono INTO prono1, prono2,pronoResultatPeno FROM LaRuche.LaRuche_pronostique WHERE pronostiqueur_id = idTemp and LaRuche_pronostique.match_id = NEW.match_id;

        IF prono1 = prono2 and NEW.nb_but_equipe1 = NEW.nb_but_equipe2 THEN
            IF prono1 = NEW.nb_but_equipe1 THEN
                IF pronoResultatPeno = NEW.resultat_peno THEN
                    SET ptTemp = (SELECT pts_Exact FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
                ELSE
                    SET ptTemp = (SELECT (pts_Exact - pts_Vainq) FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
                END IF;
            ELSE
                IF pronoResultatPeno = NEW.resultat_peno THEN
                    SET ptTemp = (SELECT pts_Ecart FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
                ELSE
                    SET ptTemp = (SELECT (pts_Ecart - pts_Vainq) FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
                END IF;
            END IF;
        ELSEIF prono1 = NEW.nb_but_equipe1 and prono2 = NEW.nb_but_equipe2 THEN
            SET ptTemp = (SELECT pts_Exact FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
        ELSEIF bonVaiqueur(prono1,prono2,pronoResultatPeno,NEW.nb_but_equipe1,NEW.nb_but_equipe2,NEW.resultat_peno) THEN
            IF ABS(prono1 - prono2) = ABS(NEW.nb_but_equipe1 - NEW.nb_but_equipe2) THEN
                SET ptTemp = (SELECT pts_Ecart FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
            ELSE
                SET ptTemp = (SELECT pts_Vainq FROM LaRuche.LaRuche_matchApronostiquer WHERE match_id = NEW.match_id);
            END IF;
        ELSE
            SET ptTemp = 0;
        END IF;

        UPDATE LaRuche.LaRuche_pronostique SET point_obtenu = ptTemp WHERE pronostiqueur_id = idTemp and LaRuche_pronostique.match_id = NEW.match_id;

    END LOOP;

    CLOSE myCursor;

    CALL LaRuche.updatePoint(idCompet);
END;

create table resultatQuestionBonus
(
    question_bonus_id int         not null
        primary key,
    bonne_reponse     varchar(20) null,
    constraint fk_resultatQuestionBonus_questionBonus
        foreign key (question_bonus_id) references questionBonus (question_bonus_id)
            on update cascade on delete cascade
);

create
    definer = admin@`%` procedure Insert150Rows()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE idTemp INT;

    -- Boucle pour effectuer 150 insertions
    WHILE i <= 150 DO

            -- Insertion dans la table
            INSERT INTO users (login, mail, description, password, age) VALUE ('clone','clone@clone.com','on est tous les meme','nike les clones',50);

            SELECT max(user_id) INTO idTemp FROM users;

            INSERT INTO pronostiqueur (user_id, competition_id) VALUE (idTemp,12);
            SET i = i + 1;
        END WHILE;
END;

create
    definer = admin@`%` function bonVaiqueur(prono1 int, prono2 int, pronoVainqueurPeno enum ('equipe1', 'equipe2'),
                                             resultat1 int, resultat2 int,
                                             resultatVainqueurPeno enum ('equipe1', 'equipe2')) returns tinyint(1)
BEGIN
    DECLARE result BOOLEAN;

    IF (prono1 - prono2) = 0 and (resultat1 - resultat2) = 0 THEN -- egalité, ne devrait pas arrivé apriori
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno IS NOT NULL and pronoVainqueurPeno = resultatVainqueurPeno THEN
        SET result = TRUE;
    ELSEIF prono1 > prono2 and (resultat1 > resultat2 or resultatVainqueurPeno = 'equipe1') THEN -- equipe1 win
        SET result = TRUE;
    ELSEIF prono1 < prono2 and (resultat1 < resultat2 or resultatVainqueurPeno = 'equipe2') THEN -- equipe2 win
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno = 'equipe1' and resultat1 > resultat2 THEN
        SET result = TRUE;
    ELSEIF pronoVainqueurPeno = 'equipe2' and resultat2 > resultat1 THEN
        SET result = TRUE;
    ELSE
        SET result = FALSE;
    END IF;

    RETURN result;
END;

create
    definer = admin@`%` function getClassement(id_pronostiqueur int, id_compet int) returns int
BEGIN

    DECLARE t INT;
    DECLARE pointUser INT;

    SELECT total_point INTO pointUser FROM pronostiqueur WHERE pronostiqueur_id = id_pronostiqueur and competition_id = id_compet;

    SELECT COUNT(*) + 1 INTO t
    FROM pronostiqueur
    WHERE competition_id = id_compet and total_point > pointUser;

    IF t IS NULL THEN
        SET t = -1;
    END IF;

    RETURN t;
END;

create
    definer = admin@`%` function totalPoint(id_pronostiqueur int, id_compet int) returns int
BEGIN

    DECLARE t INT;
    DECLARE t2 INT;

    SELECT SUM(point_obtenu) INTO t
    FROM LaRuche.LaRuche_pronostique
             NATURAL JOIN LaRuche.LaRuche_matchApronostiquer
    WHERE pronostiqueur_id = id_pronostiqueur and competition_id = id_compet;

    IF t IS NULL THEN
        SET t = 0;
    END IF;

    SELECT SUM(point_obtenu) INTO t2
    FROM LaRuche.LaRuche_pronoQuestionBonus
             NATURAL JOIN LaRuche.LaRuche_questionBonus
    WHERE pronostiqueur_id = id_pronostiqueur and competition_id = id_compet;

    IF t2 IS NULL THEN
        SET t2 = 0;
    END IF;

    RETURN t + t2;
END;

create
    definer = admin@`%` procedure updatePoint(IN idCompet int)
BEGIN
    DECLARE is_done INTEGER DEFAULT 0;

    DECLARE idTemp INT;
    DECLARE mycursor CURSOR FOR SELECT pronostiqueur_id FROM LaRuche.LaRuche_pronostiqueur WHERE competition_id = idCompet;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_done = 1;

    OPEN mycursor;

    read_loop: LOOP
        FETCH myCursor INTO idTemp;

        IF is_done = 1 THEN
            LEAVE read_loop;
        END IF;

        UPDATE LaRuche.LaRuche_pronostiqueur SET total_point = LaRuche.totalPoint(idTemp,idCompet)WHERE pronostiqueur_id = idTemp;
    END LOOP;

    CLOSE myCursor;

END;