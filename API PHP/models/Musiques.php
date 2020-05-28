<?php
class Musiques{
    // Connexion
    private $connexion;
    private $table = "musique";

    // propriétés
    public $nom_musique;
    public $nom_artiste;
    public $album;
    public $annee_publication;
    public $tableauMusiques;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des musiques
     *
     * @return void
     */
    public function lire(){
        // Ecriture de la requete
        $sql = "SELECT * FROM  musique";

        // Preparation de la requete
        $query = $this->connexion->prepare($sql);

        // Execution
        $query->execute();

        // Retour du résultat
        return $query;
    }

    /**
     * Créer une musique
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO  " . $this->table . " SET nom_musique=:nom_musique, nom_artiste=:nom_artiste, album=:album, annee_publication=:annee_publication";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection classique contre les injections
        $this->nom_musique=htmlspecialchars(strip_tags($this->nom_musique));
        $this->nom_artiste=htmlspecialchars(strip_tags($this->nom_artiste));
        $this->album=htmlspecialchars(strip_tags($this->album));
        $this->annee_publication=htmlspecialchars(strip_tags($this->annee_publication));

        // Ajout des données protégées
        $query->bindParam(":nom_musique", $this->nom_musique);
        $query->bindParam(":nom_artiste", $this->nom_artiste);
        $query->bindParam(":album", $this->album);
        $query->bindParam(":annee_publication", $this->annee_publication);

        // Exécution
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Lire une musique
     *
     * @return void
     */
    public function lireUn(){
        // Ecriture de la requete
        $sql = "SELECT * FROM musique WHERE nom_musique = ? ";

        // Preparation de la requete
        $query = $this->connexion->prepare( $sql );

        // Recherche par id (ici nom_musique)
        $query->bindParam(1, $this->nom_musique);

        // Exécution
        $query->execute();

        // Récupération de la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $this->nom_musique = $row['nom_musique'];
        $this->nom_artiste = $row['nom_artiste'];
        $this->album = $row['album'];
        $this->annee_publication = $row['annee_publication'];
    }


        /**
     * Chercher une musique par l'un de ses attributs
     *
     * @return void
     */
    public function lireParArtiste(){
        // Ecriture de la requete
        $sql = "SELECT * FROM musique WHERE nom_artiste = ? ";

        // Preparation de la requete
        $query = $this->connexion->prepare( $sql );

        // Recherche par id (ici nom_musique)
        $query->bindParam(1, $this->nom_artiste);

        // Exécution
        $query->execute();

        //$row = $query->fetch(PDO::FETCH_ASSOC);

        // $this->nom_musique = $row['nom_musique'];
        // $this->nom_artiste = $row['nom_artiste'];
        // $this->album = $row['album'];
        // $this->annee_publication = $row['annee_publication'];

        

        // On parcourt les musiques par artiste
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $m = [
                "nom_musique" => $nom_musique,
                "nom_artiste" => $nom_artiste,
                "album" => $album,
                "annee_publication" => $annee_publication,
                
            ];

            $this->tableauMusiques['musiques'][] = $m;
        }

    }



    /**
     * Supprimer un musique
     *
     * @return void
     */
    public function supprimer(){
        // Ecriture de la requete
        $sql = "DELETE FROM musique WHERE nom_musique = ?";

        // Preparation de la requete
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->nom_musique=htmlspecialchars(strip_tags($this->nom_musique));

        // On attache l'id
        $query->bindParam(1, $this->nom_musique);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }

    /**
     * Mettre à jour un musique
     *
     * @return void
     */
    public function modifier(){
        // Ecriture de la requete
        $sql = "UPDATE " . $this->table . " SET nom_musique = :nom_musique, nom_artiste = :nom_artiste, album = :album, annee_publication = :annee_publication WHERE nom_musique = :nom_musique";
        
        // Preparation de la requete
        $query = $this->connexion->prepare($sql);
        
        // Protection classique contre les injections
        $this->nom_musique=htmlspecialchars(strip_tags($this->nom_musique));
        $this->nom_artiste=htmlspecialchars(strip_tags($this->nom_artiste));
        $this->album=htmlspecialchars(strip_tags($this->album));
        $this->annee_publication=htmlspecialchars(strip_tags($this->annee_publication));
        
        // Ajout des données protégées
        $query->bindParam(':nom_musique', $this->nom_musique);
        $query->bindParam(':nom_artiste', $this->nom_artiste);
        $query->bindParam(':album', $this->album);
        $query->bindParam(':annee_publication', $this->annee_publication);
        
        // Exécution
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}    