let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let templateLiFile = await fetch('./component/NavBar/templateLi.html');
let templateLi = await templateLiFile.text();

let NavBar = {};

NavBar.format = function (data, hAbout, hHome, hProfil) {

  let html = template;

  let listmovie = "";
    for(let category of data){
        let li = templateLi;
        li = li.replaceAll("{{id}}",category.id);
        li = li.replaceAll("{{name}}",category.nom);
        listmovie += li;
    }

  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hProfil}}", hProfil);
  html = html.replaceAll('{{navbar__profils}}', listmovie);

  return html;
};

export { NavBar };
