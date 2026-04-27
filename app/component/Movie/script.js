let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let templateLiFile = await fetch("./component/Movie/templateLi.html");
let templateLi = await templateLiFile.text();

let Movie = {};

Movie.format = function (data) {
  let html = template;

  if(data.length == 0){
    return  html.replaceAll("{{list}}", "<p class = 'card__movie_error'>aucun film pour le moment</p>");
  }
 else{
 let menuHTML = "";
  for (let menu of data) {
    let li = templateLi;
    li = li.replaceAll("{{id}}", menu.id);
    li = li.replaceAll("{{img}}", "../server/images/" + menu.image);
    li = li.replaceAll("{{title}}", menu.name);

    menuHTML += li;
  }

  html = html.replaceAll("{{list}}", menuHTML);
  return html;
}
};
 

export { Movie };
