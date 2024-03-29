<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleAdmin extends Connexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function genereToken($var): string
    {
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
        srand((double)microtime() * 1000000);
        for ($i = 0; $i < $var; $i++) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        $_SESSION['token'] = $string;
        $_SESSION['creationToken'] = time();
        return $string;
    }

    public function recupereDemande()
    {
        try {
            $query = "
            SELECT prenom,user_id,login,mail,description 
            FROM laruchxsabine.LaRuche_users 
            WHERE est_verifier = false
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    private function executeQuery($stmt)
    {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupereComp()
    {

        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_competition
            ";
            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    public function deleteCompetition($id)
    {
        try {
            $query = "
            DELETE FROM laruchxsabine.LaRuche_competition 
            WHERE competition_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return -45; //pour etre sur que l'erreur n'existe pas dans mySQL

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e->getCode();
        }
    }


    public function accepteDemande($id): bool
    {

        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_users 
            SET est_verifier = true 
            WHERE user_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function refuseDemande($id): bool
    {

        try {
            $query = "
            DELETE FROM laruchxsabine.LaRuche_users 
            WHERE user_id= $id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function ajoutCompet($inputNom, $inputDetail): bool
    {
        try {
            $query = "
            INSERT INTO laruchxsabine.LaRuche_competition (nom,description,date_creation) 
            VALUES (:nom, :detail,CURDATE())
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':nom', $inputNom, PDO::PARAM_STR);
            $stmt->bindParam(':detail', $inputDetail, PDO::PARAM_STR);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e . "');</script>";
            return false;
        }
    }

    public function insererEquipe($nomEquipe)
    {
        $chemin = $this->gererLogo();
        if ($chemin == null) {
            echo "erreur";
            return false;
        }

        try {
            $query = "
            SELECT nom 
            FROM laruchxsabine.LaRuche_equipe 
            WHERE nom = '$nomEquipe'
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $res = $this->executeQuery($stmt);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }

        if (count($res) == 0) {
            try {
                $query = "
                INSERT INTO laruchxsabine.LaRuche_equipe(nom, srcLogo)
                VALUES (:nom,:chemin)
                ";
                $stmt = Connexion::$bdd->prepare($query);
                $stmt->bindParam(':nom', $nomEquipe, PDO::PARAM_STR);
                $stmt->bindParam(':chemin', $chemin, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "<script>console.log('erreur: $e');</script>";
                return false;
            }
            echo " Equipe bien enregistrée ✌️ <br>";

        } else {
            echo " Une equipe porte déja ce nom.. <br>";
            echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';


        }

    }

    public function gererLogo()
    {
        $taille = strlen(basename($_FILES["logo"]["name"]));

        $taille > 20 ?
            $nom = substr(basename($_FILES["logo"]["name"]), -20) :
            $nom = basename($_FILES["logo"]["name"]);

        $temp_name = $_FILES["logo"]["tmp_name"];
        $destination = "./style/img/logo/$nom";

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)) {
            echo "Une erreur s'est produite lors du téléchargement de l'image.<br>";
            return null;
        } else
            return $destination;
    }

    public function insererMatch($eq1, $eq2, $ptsExa, $ptsEcart, $ptsVainq, $compet, $dateMatch, $heure): bool
    {

        try {
            $query = "
            INSERT INTO laruchxsabine.LaRuche_matchApronostiquer(equipe1_id,equipe2_id,competition_id,pts_Exact,pts_Ecart,pts_Vainq,date_match,heure) 
            VALUES ($eq1,$eq2,$compet,$ptsExa,$ptsEcart,$ptsVainq,'$dateMatch',$heure);
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }

    }

    public function getMatch()
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_matchApronostiquer;
            ";
            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }

    }

    public function getMail($idUser)
    {
        try {
            $query = "
            SELECT mail
            FROM laruchxsabine.LaRuche_users
            WHERE user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }

    }

    public function getMatchAttente()
    {
        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   C.nom as nomCompet, heure
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_competition C ON M.competition_id = C.competition_id
            WHERE pari_ouvert = false AND M.match_id NOT IN (
                SELECT M.match_id
                FROM laruchxsabine.LaRuche_matchApronostiquer as M
                INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
                INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
                INNER JOIN laruchxsabine.LaRuche_competition C ON M.competition_id = C.competition_id
                INNER JOIN laruchxsabine.LaRuche_resultatMatch R ON R.match_id = M.match_id
                WHERE pari_ouvert = false
            )
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return 404;
        }
    }

    public function getMatchfermer()
    {
        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   C.nom as nomCompet, R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2,heure
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_competition C ON M.competition_id = C.competition_id
            NATURAL JOIN laruchxsabine.LaRuche_resultatMatch R
            WHERE pari_ouvert = false
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function getMatchOuvert()
    {
        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   C.nom as nomCompet, heure
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_competition C ON M.competition_id = C.competition_id
            WHERE pari_ouvert = true
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function getEquipe($idEquipe)
    {
        try {
            $query = "
            SELECT * FROM laruchxsabine.LaRuche_equipe WHERE equipe_id = $idEquipe
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getEquipes()
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_equipe
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }

    }

    public function modifieNomEquipe($inputNom, $id)
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_equipe
            SET nom = :nom
            WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':nom', $inputNom, PDO::PARAM_STR);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function rechercheUser($name)
    {
        try {
            $query = "
            SELECT * FROM laruchxsabine.LaRuche_users
            WHERE LOWER(login) LIKE '%$name%'
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function modifielogoEquipe($srcLogo, $id)
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_equipe
            SET srcLogo = :src
            WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':src', $srcLogo, PDO::PARAM_STR);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function resetPasswordUser($id)
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_users
            SET password = 'reset'
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getSrcLogoEquipe($id)
    {
        try {
            $query = "
            SELECT srcLogo FROM laruchxsabine.LaRuche_equipe WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0]['srcLogo'];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getCompet()
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_competition
            ";
            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }

    }

    public function deleteEquipe($id): bool
    {
        try {
            $query = "
            DELETE FROM laruchxsabine.LaRuche_equipe 
                   WHERE equipe_id= $id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }
    }

    public function deleteUser($id): bool
    {
        try {
            $query = "
            DELETE FROM laruchxsabine.LaRuche_users 
                   WHERE user_id= $id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }

    }

    public function miseEnAttenteMatch($match_id): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_matchApronostiquer 
            SET pari_ouvert = false 
            WHERE match_id = $match_id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function miseEnFiniMatch($match_id, $resultatEquipe1, $resultatEquipe2, $resultatPeno): bool
    {
        try {
            $query = "
            INSERT INTO laruchxsabine.LaRuche_resultatMatch(match_id, nb_but_equipe1, nb_but_equipe2,resultat_peno)
            VALUE ($match_id,$resultatEquipe1,$resultatEquipe2,$resultatPeno)
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log(\"erreur: $e\");</script>";
            return false;
        }
    }

    public function deleteMatch($idMatch)
    {
        try {
            $query = "
            DELETE FROM laruchxsabine.LaRuche_matchApronostiquer 
                   WHERE match_id=$idMatch
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return -45; //pour etre sur que l'erreur n'existe pas dans mySQL

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e->getCode();
        }
    }

    public function ajouteQuestionBonus($titre, $compet_id, $objectif, $type, $pts)
    {
        try {
            $query = "
            INSERT INTO laruchxsabine. LaRuche_questionBonus(titre, competition_id, objectif, type, point_bonne_reponse)
            VALUES (:titre,$compet_id,:objectif,'$type',$pts)
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':objectif', $objectif, PDO::PARAM_STR);
            $this->executeQuery($stmt);

            return -45;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e->getCode();
        }
    }

    public function getQuestionOuvert()
    {
        try {
            $query = "
            SELECT Q.question_bonus_id,titre,objectif,type,point_bonne_reponse,C.nom
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_competition C on Q.competition_id = C.competition_id
            WHERE pari_ouvert = true
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function getQuestionEnAttente()
    {
        try {
            $query = "
            SELECT Q.*,C.nom
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_competition C ON Q.competition_id = C.competition_id
            WHERE pari_ouvert = false and Q.question_bonus_id NOT IN(
                SELECT Q.question_bonus_id
                FROM laruchxsabine.LaRuche_questionBonus Q
                INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
                INNER JOIN laruchxsabine.LaRuche_competition C ON Q.competition_id = C.competition_id
                WHERE pari_ouvert = false
            )
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function getQuestionFini()
    {
        try {
            $query = "
            SELECT *,C.nom
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_competition C ON Q.competition_id = C.competition_id
            INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            WHERE pari_ouvert = false
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function miseEnAttenteQuestion($idQuestion): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_questionBonus 
            SET pari_ouvert = false 
            WHERE question_bonus_id = $idQuestion
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function insertResultatQuestion($idQuestion, $reponse): bool
    {
        try {
            $query = "
            INSERT INTO laruchxsabine.LaRuche_resultatQuestionBonus(question_bonus_id, bonne_reponse)
            VALUE ($idQuestion, :resultat)
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':resultat', $reponse, PDO::PARAM_STR);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }
}
