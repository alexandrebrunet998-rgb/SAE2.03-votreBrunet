let HOST_URL = "https://brunet-sae203.mmi-limoges.fr/";

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