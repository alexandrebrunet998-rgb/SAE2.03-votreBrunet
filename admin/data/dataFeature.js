let HOST_URL = "https://mmi.unilim.fr/~brunet92/SAE2.03-votreBrunet";

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