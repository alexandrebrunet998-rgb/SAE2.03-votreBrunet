let templateFile = await fetch("./component/movieDetail/template.html");
let template = await templateFile.text();

let movieDetail = {};

movieDetail.format = function (data) {
  let html = template;

  html = html.replaceAll("{{title}}", data.name); 
  html = html.replaceAll("{{img}}", "../server/images/" + data.image);
  html = html.replaceAll("{{director}}", data.director);
  html = html.replaceAll("{{year}}", data.year);
  html = html.replaceAll("{{category}}", data.category);
  html = html.replaceAll("{{min_age}}", data.min_age);
  html = html.replaceAll("{{description}}", data.description);
  html = html.replaceAll("{{trailer}}", data.trailer);

  return html;
};

export { movieDetail };

