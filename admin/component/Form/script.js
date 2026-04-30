let templateFile = await fetch('./component/Form/template.html');
let template = await templateFile.text();
let templateLiFile = await fetch('./component/Form/templateLi.html');
let templateLi = await templateLiFile.text();


let Form = {};

Form.format = function(data, handler){
    let html= template;
    html = html.replace('{{handler}}', handler);
    
    let htmlList = "";
    for(let profile of data){
        let li = templateLi;
        li = li.replaceAll("{{id}}", profile.id);
        li = li.replaceAll("{{PROFILE}}", profile.nom);
        htmlList += li;
    }

    html = html.replaceAll("{{ProfileList}}", htmlList);
    return html;
}


export { Form };