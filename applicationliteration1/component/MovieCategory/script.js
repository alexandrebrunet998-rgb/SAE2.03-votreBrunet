

import {Movie} from "../Movie/script.js"



let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function (allmovie,data) {

  let html = template;

  html = html.replaceAll("{{CateName}}", allmovie);
  let htmlmovieItems = Movie.format(data);
  html = html.replaceAll("{{List}}", htmlmovieItems);

  return html;
};

export { MovieCategory };
