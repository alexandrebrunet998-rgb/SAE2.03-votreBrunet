// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~brunet92/SAE2.03-votreBrunet"; // CHANGE THIS TO MATCH YOUR CONFIG

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

export {DataMovie};


