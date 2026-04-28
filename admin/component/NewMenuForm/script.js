

let templateFile = await fetch('./component/NewMenuForm/template.html');
let template = await templateFile.text();

let templateLiFile = await fetch('./component/NewMenuForm/templateLi.html');
let templateLi = await templateLiFile.text();


let NewMenuForm = {};

NewMenuForm.format = function(data,handler){
    let html= template;

    let listmovie = "";
    for(let category of data){
        let li = templateLi;
        li = li.replaceAll("{{id}}",category.id);
        li = li.replaceAll("{{name}}",category.name);
        listmovie += li;
    }

    html = html.replaceAll('{{handler}}', handler);
    html = html.replaceAll('{{List}}', listmovie);
    return html;
}



export {NewMenuForm};

