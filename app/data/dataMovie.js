// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~brunet92/SAE2.03-votreBrunet"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.requestMovies = async function(){
  
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies");
  
    let data = await answer.json();
    return data;
}


DataMovie.requestMovieDetails = async function (id) {
    

    let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovieDetail&id=" + id);
  
    let movieData = await answer.json();

    return movieData;
}

export {DataMovie};
