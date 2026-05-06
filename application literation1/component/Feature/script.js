let templateFile = await fetch("./component/Feature/template.html");
let template = await templateFile.text();

let templateLiFile = await fetch("./component/Feature/templateLi.html");
let templateLi = await templateLiFile.text();

let Feature = {};

Feature.format = function (data) {
    let html = template;

       let menuHTML = "";
       for (let menu of data) {
           let li = templateLi;
           li = li.replaceAll("{{Img}}", "../server/images/" + menu.image);
           li = li.replaceAll("{{Title}}", menu.name);
           li = li.replaceAll("{{Id}}", menu.id);
           
           menuHTML += li;
    
       }
       html = html.replace("{{Feature}}", menuHTML);
       return html;

   }
;

export { Feature };