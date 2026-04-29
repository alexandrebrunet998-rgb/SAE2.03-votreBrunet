<?php
require("model.php");

function readMoviesController(){
    $movies = getAllMovies();
    $category = [];

    foreach($movies as $mvs){
        $allmovie = $mvs->category_name;
        if(!isset($category[$allmovie])){
            $category[$allmovie] = [];
        }
        $category[$allmovie][] = $mvs; 
    }
    return $category;
}

function updateController(){
    $name = $_REQUEST['name'];
    $year = $_REQUEST['year'];
    $length = $_REQUEST['length'];
    $description = $_REQUEST['description'];
    $director = $_REQUEST['director'];
    $id_category = $_REQUEST['id_category'];
    $image = $_REQUEST['image'];
    $trailer = $_REQUEST['trailer'];
    $min_age = $_REQUEST['min_age'];
  
    $ok = updateMovies($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);
  
    if ($ok != 0){
        return "$name a ete ajoute"; 
    } else {
        return false;
    }
}
function profilController(){
    if(!isset($_REQUEST['nom'])) return "Nom manquant";

    $nom = $_REQUEST['nom'];
    $avatar = $_REQUEST['avatar'] ?? ""; 
    $age_restriction = $_REQUEST['age']; 
    
    $ok = updateprofil($nom, $avatar, $age_restriction);
  
    if ($ok != 0){
        return "Le profil $nom a été ajouté"; 
    } else {
        return false;
    }
}

function readMovieDetailController(){
    if(!isset($_REQUEST['id'])) {
        return false;
    }
    $id = $_REQUEST['id'];
    $movie = getMovieDetail($id);
    return $movie;
}

function readCategoryController(){
    return getCategory();
}


function readPROFILEController(){
    $profiles = getProfil();
    if($profiles !== false){
        return $profiles;
    }else{
        return false;
    }
}