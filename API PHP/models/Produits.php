<?php
class Produits{
    // Connexion
    private $connexion;
    private $table = "musique";

    // object properties
    public $nom_musique;
    public $nom_artiste;
    public $album;
    public $annee_publication;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des produits
     *
     * @return void
     */
    public function lire(){
        // On écrit la requête
        $sql = "SELECT * FROM  musique";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

    /**
     * Créer un produit
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO  " . $this->table . " SET nom_musique=:nom_musique, nom_artiste=:nom_artiste, album=:album, annee_publication=:annee_publication";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

                // Protection contre les injections
        $this->nom_musique=htmlspecialchars(strip_tags($this->nom_musique));
        $this->nom_artiste=htmlspecialchars(strip_tags($this->nom_artiste));
        $this->album=htmlspecialchars(strip_tags($this->album));
        $this->annee_publication=htmlspecialchars(strip_tags($this->annee_publication));

        # Ajout des données protégées
        $query->bindParam(":nom_musique", $this->nom_musique);
        $query->bindParam(":nom_artiste", $this->nom_artiste);
        $query->bindParam(":album", $this->album);
        $query->bindParam(":annee_publication", $this->annee_publication);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Lire un produit
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        $sql = "SELECT * FROM musique WHERE nom_musique = ? ";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->nom_musique);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->nom_musique = $row['nom_musique'];
        $this->nom_artiste = $row['nom_artiste'];
        $this->album = $row['album'];
        $this->annee_publication = $row['annee_publication'];
    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM musique WHERE nom_musique = ?";

        // On prépare la requête
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
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET nom_musique = :nom_musique, nom_artiste = :nom_artiste, album = :album, annee_publication = :annee_publication WHERE nom_musique = :nom_musique";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->nom_musique=htmlspecialchars(strip_tags($this->nom_musique));
        $this->nom_artiste=htmlspecialchars(strip_tags($this->nom_artiste));
        $this->album=htmlspecialchars(strip_tags($this->album));
        $this->annee_publication=htmlspecialchars(strip_tags($this->annee_publication));
        
        // On attache les variables
        $query->bindParam(':nom_musique', $this->nom_musique);
        $query->bindParam(':nom_artiste', $this->nom_artiste);
        $query->bindParam(':album', $this->album);
        $query->bindParam(':annee_publication', $this->annee_publication);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}    