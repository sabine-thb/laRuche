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
            $stmt = Connexion::$bdd->prepare("SELECT user_id,login,mail,description FROM LaRuche.users WHERE est_verifier=false");
            //  echo var_dump($resultat);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    public function recupereComp() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT * FROM LaRuche.competition");
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
    }

    public function deleteCompetition($id)
    {
        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.competition WHERE competition_id=$id");
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
            $stmt = Connexion::$bdd->prepare("UPDATE LaRuche.users SET est_verifier=true WHERE user_id=$id");
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
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.users WHERE user_id=$id");
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
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.competition (nom,description,date_creation) VALUES ('$nom', '$detail',CURDATE())");
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }

    public function insererEquipe($nom){
        $chemin= $this->gererLogo();

        try{
        $stmt = Connexion::$bdd->prepare("SELECT nom FROM LaRuche.equipe Where nom='$nom';");
        $res=$this->executeQuery($stmt);
        }catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }   

        if(count($res)==0){
            try{
                $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.equipe(nom, srcLogo) VALUES ('$nom','$chemin');");
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
            INSERT INTO LaRuche.matchApronostiquer(equipe1_id,equipe2_id,competition_id,pts_Exact,pts_Ecart,pts_Vainq,date_match,heure) 
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
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche.matchApronostiquer;");
            return $this->executeQuery($stmt);
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
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.competition C ON M.competition_id = C.competition_id
            WHERE pari_ouvert = false
            EXCEPT 
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   C.nom as nomCompet,heure
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche.competition C ON M.competition_id = C.competition_id
            NATURAL JOIN LaRuche.resultatMatch
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
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche.competition C ON M.competition_id = C.competition_id
            NATURAL JOIN LaRuche.resultatMatch R
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
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.competition C ON M.competition_id = C.competition_id
            WHERE pari_ouvert = true
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function getEquipes(){
        try{
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche.equipe;");
            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
        
    }
    public function getCompet(){
        try{
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche.competition;");
            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return $e;
        }
        
    }
    public function deleteEquipe($id): bool
    {
        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.equipe WHERE equipe_id=$id");
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return false;
        }
    }

    public function gererLogo(): string
    {
        
        $temp_name = $_FILES["logo"]["tmp_name"];
        $name = $_FILES["logo"]["name"];
        $destination = "./style/img/logo/" . $name;

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)){
            echo "Une erreur s'est produite lors du téléchargement de l'image.<br>";
        }
            
        return $destination;
    }

    public function miseEnAttenteMatch($match_id): bool
    {
        try {
            $query = "
            UPDATE LaRuche.matchApronostiquer 
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
            INSERT INTO LaRuche.resultatMatch(match_id, nb_but_equipe1, nb_but_equipe2,resultat_peno)
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
}
