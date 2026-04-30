<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
 define("DBNAME", "SAE203");
define("DBLOGIN", "userSAE203");
 define("DBPWD", "lamereagabriel24.");

//define("DBNAME", "brunet92");
//define("DBLOGIN", "brunet92");
//define("DBPWD", "brunet92");




function getAllMovies($min_age){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    $sql = "SELECT Movie.*, Category.name AS category_name 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.min_age <= :min_age
            ORDER BY Category.name, Movie.name";
            
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':min_age', $min_age, PDO::PARAM_INT); 
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    $groupedData = [];
    foreach ($res as $m) {
        $cat = $m->category_name;
        if (!isset($groupedData[$cat])) {
            $groupedData[$cat] = [];
        }
        $groupedData[$cat][] = $m;
    }
    
    return $groupedData; 
}

function updateMovies($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD); 
    
    $sql = "INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age)
            VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)";
    
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':length', $length);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':id_category', $id_category);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':trailer', $trailer);
    $stmt->bindParam(':min_age', $min_age);
    $stmt->execute();
    $res = $stmt->rowCount(); 
    return $res; 
}

function updateprofil($nom, $avatar, $age_restriction){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD); 
    
    // Correction : On retire les virgules devant les noms de colonnes et le champ ID 
    // (si l'ID est en auto-increment dans ta base, ne l'insère pas manuellement)
    $sql = "INSERT INTO PROFILE (nom, avatar, age_restriction)
            VALUES (:nom, :avatar, :age_restriction)";
    
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':age_restriction', $age_restriction);
    
    $stmt->execute();
    return $stmt->rowCount(); 
}

function updateExistingProfil($id, $nom, $avatar, $age_restriction) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD); 
    
    $sql = "UPDATE PROFILE 
            SET nom = :nom, avatar = :avatar, age_restriction = :age_restriction 
            WHERE id = :id";
    
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':age_restriction', $age_restriction);
    
    $stmt->execute();
    return $stmt->rowCount(); 
}

function getMovieDetail($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Movie WHERE id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ); 
}
function getCategory(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT id,name from Category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ); 
}
function getCate(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ); 
}

function getProfil() {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD); 
    $sql = "SELECT * FROM PROFILE"; 
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ); 
}