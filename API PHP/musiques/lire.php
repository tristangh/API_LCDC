<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Musiques.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les musiques
    $musique = new Musiques($db);

    // On récupère les données
    $stmt = $musique->lire();

    // On vérifie si on a au moins 1 musique
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauProduits = [];
        $tableauProduits['musiques'] = [];

        // On parcourt les musiques
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $m = [
                "nom_musique" => $nom_musique,
                "nom_artiste" => $nom_artiste,
                "album" => $album,
                "annee_publication" => $annee_publication,
                
            ];

            $tableauProduits['musiques'][] = $m;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauProduits);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}