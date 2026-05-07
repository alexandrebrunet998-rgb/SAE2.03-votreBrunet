let HOST_URL = "https://brunet-sae203.mmi-limoges.fr/";

let DataFeature = {};


DataFeature.requestFeatured = async function () {
    let url = "/server/script.php?todo=getFeatured";
    let answer = await fetch(HOST_URL + url);
    let data = await answer.json();
    
    return data;
};

DataFeature.updateStatus = async function (pdata) {
    let config = {
        method: "POST",
        body: pdata 
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=updateFeaturedStatus", config);
    let data = await answer.json();
    return data;
};

export { DataFeature };