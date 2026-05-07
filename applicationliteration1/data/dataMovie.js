// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://brunet-sae203.mmi-limoges.fr/"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};


DataMovie.requestMovieDetails = async function (id) {
    

    let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovieDetail&id=" + id);
  
    let movieData = await answer.json();

    return movieData;

}
DataMovie.requestMovies = async function( min_age ) {
    
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies&min_age=" + min_age );
    let data = await answer.json();
    return data;
}
DataMovie.addFavorite = async function(id_profil, id_film) {
    let url = "../server/script.php?todo=addFav&id_profil=" + id_profil + "&id_film=" + id_film;
    let response = await fetch(url);
    let result = await response.json();
    return result;
}
DataMovie.getFavorites = async function(id_profil) {
    let url = "../server/script.php?todo=getFavs&id_profil=" + id_profil;
    let response = await fetch(url);
    let favoris = await response.json();
    return favoris;
};
DataMovie.deleteFavorite = async function(id_profil, id_film) {
    let url = "../server/script.php?todo=deleteFav&id_profil=" + id_profil + "&id_film=" + id_film;
    let response = await fetch(url);
    let result = await response.json();
    return result;
};
DataMovie.requestFeatured = async function () {
    let url = "/server/script.php?todo=readFeature";
    let answer = await fetch(HOST_URL + url);
    let data = await answer.json();
    return data;
}

export {DataMovie};


