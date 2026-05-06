<?php
require("model.php");

// ----------------------------------------------------
// GESTION DES FILMS
// ----------------------------------------------------

function readMoviesController() {
    if (isset($_REQUEST['min_age'])) {
        $age = $_REQUEST['min_age'];
    } else {
        $age = 0;
    }

    $movies = getAllMovies($age); 
    
    return $movies;
}

function updateController() {
    $name        = $_REQUEST['name'];
    $year        = (int) $_REQUEST['year']; 
    $min_age     = (int) $_REQUEST['min_age'];
    $length      = (int) $_REQUEST['length'];
    $description = $_REQUEST['description'];
    $director    = $_REQUEST['director'];
    $id_category = (int) $_REQUEST['id_category'];
    $image       = $_REQUEST['image'];
    $trailer     = $_REQUEST['trailer'];

    $ok = updateMovies($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);
    
    if ($ok > 0) {
        return ["status" => "success", "message" => "Film ajouté !"];
    } else {
        return ["status" => "error", "message" => "Ça n'a pas marché..."];
    }
}

function readMovieDetailController() {
    if (!isset($_REQUEST['id'])) {
        return false; 
    }
    
    $id = $_REQUEST['id'];
    $movie = getMovieDetail($id);
    
    return $movie;
}

function readFeaturedController() {
    $movies = getFeaturedMovies(); 
    
    if ($movies !== false) {
        return $movies;
    } else {
        return [];
    }
}

// ----------------------------------------------------
// GESTION DES PROFILS
// ----------------------------------------------------

function profilController() {
    if (!isset($_REQUEST['nom'])) {
        return ["status" => "error", "message" => "Nom manquant"];
    }
    
    $nom    = $_REQUEST['nom'];
    $avatar = $_REQUEST['avatar']; 
    $age    = $_REQUEST['age_restriction']; 
    
    $ok = updateprofil($nom, $avatar, $age);
    
    if ($ok != 0) {
        return ["status" => "success", "message" => "Profil créé !"]; 
    } else {
        return ["status" => "error", "message" => "Erreur SQL lors de la création"];
    }
}

function updateProfileController() {
    if (!isset($_REQUEST['id']) || !isset($_REQUEST['nom'])) {
        return ["status" => "error", "message" => "ID ou Nom manquant"];
    }

    $id     = $_REQUEST['id'];
    $nom    = $_REQUEST['nom'];
    $avatar = $_REQUEST['avatar']; 
    $age    = $_REQUEST['age_restriction']; 
    
    $ok = updateExistingProfil($id, $nom, $avatar, $age);
    
    if ($ok !== false) {
        return ["status" => "success", "message" => "Profil mis à jour !"]; 
    } else {
        return ["status" => "error", "message" => "Erreur SQL lors de la modification"];
    }
}

function readPROFILEController() {
    $profiles = getProfil();
    
    if ($profiles !== false) {
        return $profiles;
    } else {
        return false;
    }
}

// ----------------------------------------------------
// GESTION DES FAVORIS
// ----------------------------------------------------

function addFavController() {
    // On s'assure qu'on a bien le profil et le film
    if (!isset($_REQUEST['id_profil']) || !isset($_REQUEST['id_film'])) {
        return ["status" => "error", "message" => "Données manquantes"];
    }

    $id_p = $_REQUEST['id_profil'];
    $id_f = $_REQUEST['id_film'];
    
    $res = addFavoris($id_p, $id_f);
  
    return [
        "status" => "success",
        "message" => "Le film a été ajouté à vos favoris",
        "resultat" => $res
    ];
}

function deleteFavController() {
    if (!isset($_REQUEST['id_profil']) || !isset($_REQUEST['id_film'])) {
        return ["status" => "error", "message" => "Données manquantes pour la suppression"];
    }
    
    $id_p = $_REQUEST['id_profil'];
    $id_f = $_REQUEST['id_film'];
    
    $nb = deleteFavoris($id_p, $id_f);
    
    if ($nb > 0) {
        return ["status" => "success", "message" => "Le film a été retiré de vos favoris"];
    } else {
        return ["status" => "error", "message" => "Le film n'était pas dans vos favoris"];
    }
}

function getFavsController() {
    if (isset($_REQUEST['id_profil'])) {
        $id_p = $_REQUEST['id_profil'];
        return getFavorisByProfil($id_p); 
    } else {
        return []; 
    }
}

// ----------------------------------------------------
// AUTRES
// ----------------------------------------------------

function readCategoryController() {
    return getCategory();
}