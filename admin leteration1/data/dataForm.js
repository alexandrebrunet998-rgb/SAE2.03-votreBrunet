let HOST_URL = "https://mmi.unilim.fr/~brunet92/SAE2.03-votreBrunet";

let dataForm = {};

dataForm.readAll = async function() {
    let response = await fetch(HOST_URL + "/server/script.php?todo=readProfils");
    return await response.json();
};

dataForm.update = async function(fd) {
    let response = await fetch(HOST_URL + '/server/script.php?todo=updateProfile', {
        method: 'POST',
        body: fd
    });
    return await response.json();
};

export { dataForm };