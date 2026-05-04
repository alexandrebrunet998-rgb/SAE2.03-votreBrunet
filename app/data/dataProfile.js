let HOST_URL = "https://mmi.unilim.fr/~brunet92/SAE2.03-votreBrunet"; 

let DataProfile = {};

DataProfile.readAll = async function () {
   
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfils");
  
    let profiles = await answer.json();

    return profiles;
};

DataProfile.requestProfileDetails = async function (id) {
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfils&id=" + id);
    return await answer.json();
};

export { DataProfile };