ITÉRATIONS 1, 4 et 7 : Liste des films, Catégories et Filtrage par âge
Ces trois itérations sont regroupées dans ma fonction getAllMovies($min_age).

Requête SQL :

SQL
SELECT Movie.*, Category.name AS category_name
FROM Movie
INNER JOIN Category ON Movie.id_category = Category.id
WHERE Movie.min_age <= :min_age
ORDER BY Category.name, Movie.name
Justification de la Base de Données :
Table Category : Création d'une table dédiée avec un id (Clé Primaire, INT AUTO_INCREMENT) et un name (VARCHAR). Cela évite la redondance des noms de catégories dans la table des films et facilite les mises à jour.
Table Movie (Relations) : Ajout d'une clé étrangère id_category (INT) pointant vers Category.id. C'est une relation 1-à-N (une catégorie contient plusieurs films, un film a une seule catégorie).
Table Movie (Types) : L'ajout de la colonne min_age (INT) permet de filtrer mathématiquement les films (Itération 7).
Optimisation : Le tri ORDER BY Category.name directement en SQL est un excellent choix, car il facilite grandement le regroupement des données dans votre boucle foreach en PHP (Itération 4).




ITÉRATION 2 : Ajouter des films
Requête SQL (via la fonction updateMovies) :
SQL
INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age)
VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)
Justification de la Base de Données (Table Movie) :
id : INT, AUTO_INCREMENT, Clé Primaire. Indispensable pour identifier chaque film de manière unique.
name, director : VARCHAR(255). Longueur standard suffisante pour des noms.
description : TEXT. Nécessaire car un synopsis dépasse souvent la limite classique de 255 caractères d'un VARCHAR.
year, length, min_age : INT (ou SMALLINT/TINYINT pour optimiser l'espace). Utiliser des entiers permet des tris et des filtres précis.
image, trailer : VARCHAR(255). On stocke ici uniquement le nom du fichier image et l'URL du trailer, pas les médias eux-mêmes (bonne pratique).




ITÉRATION 3 : Détails d'un film
Requête SQL :
SQL
SELECT * FROM Movie WHERE id = :id
Justification : L'utilisation de la clé primaire id pour la recherche garantit une requête ultra-rapide (les clés primaires sont automatiquement indexées par MySQL) et garantit le retour d'un seul et unique enregistrement.



ITÉRATIONS 5 et 6 : Ajouter et Lister des profils
Requêtes SQL :
Ajout (updateprofil) :
SQL
INSERT INTO PROFILE (nom, avatar, age_restriction) VALUES (:nom, :avatar, :age_restriction)
Lecture (getProfil) :
SQL
SELECT * FROM PROFILE
Justification de la Base de Données (Table PROFILE) 
Création d'une nouvelle table indépendante.
id : INT AUTO_INCREMENT, Clé Primaire
nom : VARCHAR(100).
avatar : VARCHAR(255) (nom du fichier image).
age_restriction : INT. Ce choix de type est crucial car il doit correspondre au type de Movie.min_age pour permettre la comparaison de l'Itération 7 (Movie.min_age <= :min_age).





ITÉRATION 8 : Modifier un profil
Requête SQL :
SQL
UPDATE PROFILE
SET nom = :nom, avatar = :avatar, age_restriction = :age_restriction
WHERE id = :id
Justification : L'utilisation de la clause WHERE id = :id est obligatoire ici. Sans elle, la requête mettrait à jour tous les profils de la base de données. Le ciblage par clé primaire est le moyen le plus sûr d'éditer une ressource.





ITÉRATIONS 9 et 10 : Gestion des Favoris (Ajouter, Lister, Retirer)
Requêtes SQL :

Ajout : INSERT IGNORE INTO FAVORIS (id_profil, id_film) VALUES (:p, :f)
Lecture : SELECT Movie.* FROM Movie INNER JOIN FAVORIS ON Movie.id = FAVORIS.id_film WHERE FAVORIS.id_profil = :p
Retrait : DELETE FROM FAVORIS WHERE id_profil = :p AND id_film = :f
Justification de la Base de Données (Table FAVORIS) :
Table d'association : Vous avez créé la table FAVORIS pour gérer une relation N-à-N (Many-to-Many). Un profil peut aimer plusieurs films, et un film peut être aimé par plusieurs profils.
Clé primaire composite : La table contient id_profil (Clé étrangère vers PROFILE.id) et id_film (Clé étrangère vers Movie.id). La combinaison de ces deux colonnes doit être définie comme Clé Primaire Composite.
L'astuce du INSERT IGNORE : C'est un excellent choix. Grâce à la clé primaire composite, la base de données refusera d'insérer un doublon (un profil qui ajoute deux fois le même film). Le mot-clé IGNORE permet à la requête d'échouer silencieusement sans faire planter l'application PHP.





ITÉRATION 11 : Films mis en avant
Requête SQL :
SQL
SELECT * FROM Movie WHERE is_featured = 1
Justification de la Base de Données :
Modification de la table Movie existante pour y ajouter une colonne is_featured.
Type de données : Le type idéal ici est un TINYINT(1) ou BOOLEAN. Cela permet de stocker un état binaire (0 = non mis en avant, 1 = mis en avant). C'est la méthode la plus optimisée, évitant de créer une table séparée juste pour cette fonctionnalité.



CARDINALITE 
Entre Movie (Film) et Category (Genre)
Lien : (1,1) et (0,n)

Côté Movie (1,1) :  

J'ai choisi la cardinalité (1,1) car, dans le cadre de cette application, chaque film doit obligatoirement être classé dans une catégorie pour faciliter la navigation, et il ne peut appartenir qu'à un seul genre principal afin d'éviter les doublons dans l'affichage. 

Côté Category (0,n) :  

J'ai choisi la cardinalité (0,n) car une catégorie peut exister dans la base sans encore avoir de films associés (par exemple, une nouvelle catégorie "Western" vide), ou à l'inverse, contenir une liste illimitée de films. 

2. Entre PROFILE (Utilisateur) et Movie (via FAVORIS)
Lien : (0,n) et (0,n)

Côté PROFILE (0,n) : 
 J'ai choisi la cardinalité (0,n) car un utilisateur qui vient de créer son compte n'a pas encore forcément de favoris (0), mais il doit pouvoir en ajouter autant qu'il le souhaite au fil du temps (n). 

Côté Movie (0,n) : 

 J'ai choisi la cardinalité (0,n) car un film peut être très populaire et figurer dans les listes de nombreux profils (n), ou au contraire n'être encore présent dans aucun favori s'il vient d'être ajouté au catalogue (0). 


et le lopping est dans un fichier dans les images /server/images/looping