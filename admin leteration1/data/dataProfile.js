let HOST_URL = "https://brunet-sae203.mmi-limoges.fr/";

let DataProfile = {};

DataProfile.add = async function (pdata) {
  
    let config = {
        method: "POST", 
        body: pdata 
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=profil", config);
    let data = await answer.json();
    return data;
}

DataProfile.update = async function (pdata) {
  
    let config = {
        method: "POST", 
        body: pdata 
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=updateProfile", config);
    let data = await answer.json();
    return data;
}
DataProfile.requestProfiles = async function(id = null){
    let url = "/server/script.php?todo=readProfils"; 
    if(id){
        url += "&id=" +id;
    }
    let answer = await fetch(HOST_URL + url);
    let data = await answer.json();
    return data;
}
export { DataProfile };