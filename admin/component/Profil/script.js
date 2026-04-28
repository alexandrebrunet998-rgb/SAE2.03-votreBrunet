

let templateFile = await fetch('./component/Profil/template.html');
let template = await templateFile.text();


let NewMenuForm = {};

NewMenuForm.format = function(handler){
    let html= template;

    html = html.replaceAll('{{handler}}', handler);
    return html;
}



export {NewMenuForm};


