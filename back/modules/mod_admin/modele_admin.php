<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleAdmin extends Connexion {

    public function __construct() {
        parent::__construct();
    }


    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function genereToken($var): string
    {
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$var; $i++){
            $string .= $chaine[rand()%strlen($chaine)];
        }
        $_SESSION['token']=$string;
        $_SESSION['creationToken']= time();
        return $string;
    }


    public function recupereDemande() {
        try {
            $query = "
            SELECT prenom,user_id,login,mail,description FROM LaRuche_users WHERE est_verifier=false
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    public function recupereComp() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT * FROM LaRuche_competition");
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    public function deleteCompetition($id)
    {
        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche_competition WHERE competition_id=$id");
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
            $stmt = Connexion::$bdd->prepare("UPDATE LaRuche_users SET est_verifier=true WHERE user_id=$id");
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
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche_users WHERE user_id=$id");
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function ajoutCompet($nom,$detail): bool
    {
        try {
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche_competition (nom,description,date_creation) VALUES ('$nom', '$detail',CURDATE())");
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }

    public function insererEquipe($nomEquipe){
        $chemin= $this->gererLogo();
        if ($chemin == null){
            echo "erreur";
            return false;
        }

        try{
            $stmt = Connexion::$bdd->prepare("SELECT nom FROM LaRuche_equipe WHERE nom = '" . $nomEquipe . "'");
            $res=$this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }   

        if(count($res)==0){
            try{
                $query = "
                INSERT INTO LaRuche_equipe(nom, srcLogo)
                VALUES ('$nomEquipe','$chemin')
                ";
                $stmt = Connexion::$bdd->prepare($query);
                $stmt->execute();
            }catch (PDOException $e) {
                echo "<script>console.log('erreur: $e');</script>";
                return false;
            }      
            echo " Equipe bien enregistrée ✌️ <br>";

        }else{
            echo" Une equipe porte déja ce nom.. <br>";
            echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';


        }

    }

    public function insererMatch($eq1,$eq2,$ptsExa,$ptsEcart,$ptsVainq,$compet,$dateMatch,$heure): bool
    {

        try{
            $query = "
            INSERT INTO LaRuche_matchApronostiquer(equipe1_id,equipe2_id,competition_id,pts_Exact,pts_Ecart,pts_Vainq,date_match,heure) 
            VALUES ($eq1,$eq2,$compet,$ptsExa,$ptsEcart,$ptsVainq,'$dateMatch',$heure);
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->execute();

            return true;
        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }

    }

    public function getMatch(){
        try{
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche_matchApronostiquer;");
            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }
    
    }

    public function getMail($idUser){
        try{
            $query = "
            SELECT mail
            FROM LaRuche_users
            WHERE user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0];
        }catch (PDOException $e) {
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
            FROM LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche_competition C ON M.competition_id = C.competition_id
            WHERE pari_ouvert = false
            EXCEPT 
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   C.nom as nomCompet,heure
            FROM LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche_competition C ON M.competition_id = C.competition_id
            NATURAL JOIN LaRuche_resultatMatch
            WHERE pari_ouvert = false
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
            FROM LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche_competition C ON M.competition_id = C.competition_id
            NATURAL JOIN LaRuche_resultatMatch R
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
            FROM LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche_competition C ON M.competition_id = C.competition_id
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
            SELECT * FROM LaRuche_equipe WHERE equipe_id = $idEquipe
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getEquipes(){
        try{
            $query = "
            SELECT * 
            FROM LaRuche_equipe
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
        
    }

    public function modifieNomEquipe($nom,$id)
    {
        try {
            $query = "
            UPDATE LaRuche_equipe
            SET nom = '$nom'
            WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
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
            SELECT * FROM LaRuche_users
            WHERE LOWER(login) LIKE '%$name%'
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function modifielogoEquipe($srcLogo,$id)
    {
        try {
            $query = "
            UPDATE LaRuche_equipe
            SET srcLogo = '$srcLogo'
            WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
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
            UPDATE LaRuche_users
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
            SELECT srcLogo FROM LaRuche_equipe WHERE equipe_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0]['srcLogo'];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getCompet(){
        try{
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche_competition;");
            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
        
    }
    public function deleteEquipe($id): bool
    {
        try {
            $query = "
            DELETE FROM LaRuche_equipe WHERE equipe_id=$id
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
            DELETE FROM LaRuche_users WHERE user_id=$id
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }
        
    }
    
    public function gererLogo()
    {
        $taille = strlen(basename($_FILES["logo"]["name"]));

        $taille> 20 ?
            $nom = substr(basename($_FILES["logo"]["name"]), -20) :
            $nom = basename($_FILES["logo"]["name"]);

        $temp_name = $_FILES["logo"]["tmp_name"];
        $destination = "./style/img/logo/$nom";

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)){
            echo "Une erreur s'est produite lors du téléchargement de l'image.<br>";
            return null;
        }else
            return $destination;
    }

    public function miseEnAttenteMatch($match_id): bool
    {
        try {
            $query = "
            UPDATE LaRuche_matchApronostiquer 
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

    public function miseEnFiniMatch($match_id, $resultatEquipe1, $resultatEquipe2,$resultatPeno): bool
    {
        try {
            $query = "
            INSERT INTO LaRuche_resultatMatch(match_id, nb_but_equipe1, nb_but_equipe2,resultat_peno)
            VALUE ($match_id,$resultatEquipe1,$resultatEquipe2,$resultatPeno)
            ";

            var_dump($query);

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
//            var_dump($e);
            echo "<script>console.log(\"erreur: $e\");</script>"; //todo provoque une erreur car le $e n'est pas collé avec le );
            return false;
        }
    }

    public function deleteMatch($idMatch)
    {
        try {
            $query = "
            DELETE FROM LaRuche_matchApronostiquer WHERE match_id=$idMatch
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
            INSERT INTO LaRuche_questionBonus(titre, competition_id, objectif, type, point_bonne_reponse)
            VALUES ('$titre',$compet_id,'$objectif','$type',$pts)
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return -45;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e->getCode();
        }
    }

    public function getQuestionAttente()
    {
        try{
            $query = "
            SELECT Q.question_bonus_id,titre,objectif,type,point_bonne_reponse,C.nom
            FROM LaRuche_questionBonus Q
            INNER JOIN LaRuche_competition C on Q.competition_id = C.competition_id
            WHERE pari_ouvert = true
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getQuestionEnCours()
    {
        try{
            $query = "
            SELECT Q.*,C.nom
            FROM LaRuche_questionBonus Q
            INNER JOIN LaRuche_competition C ON Q.competition_id = C.competition_id
            WHERE pari_ouvert = false 
            EXCEPT 
            SELECT Q.*,C.nom
            FROM LaRuche_questionBonus Q
            INNER JOIN LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            INNER JOIN LaRuche_competition C ON Q.competition_id = C.competition_id
            WHERE pari_ouvert = false
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getQuestionFini()
    {
        try{
            $query = "
            SELECT *
            FROM LaRuche_questionBonus Q
            INNER JOIN LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            WHERE pari_ouvert = false
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function miseEnAttenteQuestion($idQuestion): bool
    {
        try {
            $query = "
            UPDATE LaRuche_questionBonus 
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
}
