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

    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->nom_musique)){
        $musique->nom_musique = $donnees->nom_musique;

        // On récupère le musique
        $musique->lireUn();

        // On vérifie si le musique existe
        if($musique->nom_musique!= null){

            $m = [
                "nom_musique" => $musique->nom_musique,
                "nom_artiste" => $musique->nom_artiste,
                "album" => $musique->album,
                "annee_publication" => $musique->annee_publication,
                
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($m);
        }else{
            // 404 Not found
            http_response_code(404);
         
            echo json_encode(array("message" => "Le musique n'existe pas."));
        }
        
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}