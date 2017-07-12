CREATE DATABASE nom_de_la_base; -- Créer une nouvelle Base de données

SHOW DATABASES; -- permet de voir les bases de données

USE nom_de_la_base; -- selectionner et utiliser la base de données

DROP DATABASE nom_de_la_base; -- supprimer une base de données

DROP table nom_de_la_table; -- supprimer une table 

TRUNCATE nom_de_la_table; -- vider la table

--------------------------------------------------------
-- REQUETE DE SELECTION

-- AFFICHAGE COMPLET 
SELECT id_employes, prenom, nom, sexe, service, date_embauche, salaire FROM employes;

SELECT * FROM employes; -- affichage de la table employes avec le raccourci de l'étoile "*" pour dire "ALL"
-- affiche-moi [* toutes les colonnes] de [la table employes]

-----------------------------------------------------------------

-- Quels sont les noms et prenom des employes travaillant dans l'entreprise ?
SELECT nom, prenom FROM employes;

-----------------------------------------------------------------

-- Quels sont les différents service occupée par les employés travaillant dans l'entreprise ?
SELECT service FROM employes;

----------------------------------------------------------------
-- DISTINCT
-- Affichage des services différents 
SELECT DISTINCT service FROM employes;
-- DISTINCT permet d'éliminer les doublons

----------------------------------------------------------------
-- Condition WHERE
-- Affichage des employes du service informatique
SELECT nom, prenom, service FROM employes WHERE service = 'informatique';
-- WHERE = à condition que
-- WHERE [colonne = valeur]

----------------------------------------------------------------
-- BETWEEN
-- Affichage des employes ayant été recrutés entre 2010 et aujourd'hui
SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2017-04-11'; 

SELECT CURDATE(); -- affiche la date du jour
SELECT NOW(); -- affiche la date du jour 

SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND CURDATE(); 
-- BETWEEN + AND = entre ... et ...
-- Pas de difference entre les quotes ' et les guillemets ". Quand il y a une valeur il faut mettre les guillemets " ou les quotes ', en revanche quand il s'agit d'un chiffre, on ne doit pas les mettre

-----------------------------------------------------------------
-- LIKE : valeur approchante
-- Affichage des employes ayant un prenom commençant par la lettre 's'
SELECT prenom FROM employes WHERE prenom LIKE 's%'; -- Je souhaite connaitre le prenom des personnes commençant par la lettre "s"

SELECT prenom FROM employes WHERE prenom LIKE '%s'; -- Je souhaite connaitre le prenom des personnes finissant par la lettre "s"

SELECT prenom FROM employes WHERE prenom LIKE '%-%'; -- Je souhaite connaitre le prenom des personnes de l'entreprise qui contient un trait d'union dans leur prénom

-- % : peut importe la suite...

-- ID ---- nom ---- code_postal
-- 1 	Appart1 	75015	
-- 2 	Appart2 	75011	
-- 3	Appart3 	75016	
-- 4	Appart4 	95000

-- SELECT * FROM appartement WHERE code_postal = 75;	
-- SELECT * FROM appartement WHERE code_postal LIKE '75%';	

------------------------------------------------------------------
-- Affichage de tous les employes (sauf les informaticiens)
SELECT * FROM employes WHERE service != 'informatique'; -- Je souhaite connaitre le nom et prénom de tous les employes de l'entreprise NE travaillant PAS dans le service informatique
-- != différent de ...

-- OPERATEURS DE COMPARAISON 
-- = 	"est égal"
-- > 	"strictement supérieur"
-- < 	"strictement inférieur"
-- >= 	"inférieur ou égal à"
-- <= 	"supérieur ou égal à"
-- <> ou != 	"différent de"

--------------------------------------------------------------------
-- Afficher le nom, prenom, service et salaire des employes de l'entreprise ayant un salaire supérieur à 3000€
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;

--------------------------------------------------------------------
-- ORDER BY
-- Affichage des employes dans l'ordre alphabétique
SELECT prenom FROM employes ORDER BY prenom ASC;
SELECT prenom FROM employes ORDER BY prenom;
SELECT prenom FROM employes ORDER BY prenom DESC;
SELECT prenom, salaire FROM employes ORDER BY salaire DESC;
-- ORDER BY permet d'effectuer un classement
-- ASC : Ascendant croissant
-- DESC : Descendant décroissant

---------------------------------------------------------------------
-- LIMIT 
-- Affichage des employes 3 par 3
SELECT prenom, nom FROM employes ORDER BY prenom LIMIT 0,3; 
-- LIMIT 0,3 : 0 est la position de départ de mon tableau et 3 est le nombre d'employés que je souhaite afficher 

---------------------------------------------------------------------
-- Affichage des employes avec un salaire annuel
SELECT prenom, salaire*12 FROM employes;
SELECT prenom, salaire*12 AS 'Salaire annuel' FROM employes;
-- AS : Alias

---------------------------------------------------------------------
-- SUM
-- Affichage de la "masse salariale" sur 12 mois
SELECT SUM(salaire*12) AS 'masse salariale sur 1 année' FROM employes;
-- SUM : Somme

---------------------------------------------------------------------
-- AVG
-- affichage du salaire moyen
SELECT AVG(salaire) AS 'Salaire moyen' FROM employes;
-- AVG : moyenne
-- ROUND
SELECT ROUND(AVG(salaire)) AS 'Salaire moyen' FROM employes;
SELECT ROUND(AVG(salaire),2) AS 'Salaire moyen' FROM employes;
-- ROUND permet d'arrondir ROUND(...,2) le 2 permet d'afficher un chiffre arrondi à 2 chiffres aprés la virgule

---------------------------------------------------------------------
-- COUNT
-- Affichage du nombre de femme(s) travaillant dans l'entreprise
SELECT COUNT(*) AS 'Nombre de femmes' FROM employes WHERE sexe = 'f';
-- COUNT permet de compter

---------------------------------------------------------------------
-- MIN / MAX 
-- Affichage du salaire minimum / maximum
SELECT MIN(salaire) FROM employes;
SELECT MAX(salaire) FROM employes;

-- Exercice : Afficher le prenom et le salaire de l'employes ayant le salaire le plus petit
SELECT prenom, MIN(salaire) FROM employes;

SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);
-- requete détaillée : 
SELECT prenom, salaire FROM employes WHERE salaire = 1390; 
SELECT * FROM employes WHERE salaire = 1390;
SELECT prenom, salaire FROM employes ORDER BY salaire LIMIT 0,1;

--------------------------------------------------------------------
-- IN 
-- Je souhaite connaitre le prénom des employes travaillant dans le service comptabilité et le service informatique
SELECT prenom, service FROM employes WHERE service IN('informatique','comptabilite');
-- IN permet de selctionner plusieurs valeurs
-- = permet de selectionner une seule valeur
 
---------------------------------------------------------------------
-- NOT
-- Je souhaite connaitre le prénom des employes ne travaillant pas dans les services informatique et comptabilité
SELECT prenom, service FROM employes WHERE service NOT IN('informatique','comptabilite');

-- A l'inverse, pour connaitre le prénom des employes ne faisant pas partie des services comptabilité et informatique, classé par service
SELECT prenom, nom, service FROM employes WHERE service NOT IN('informatique','comptabilite') ORDER BY service;

---------------------------------------------------------------------
-- Exercice : Je souhaite connaitre le prenom et le nom des employes du service commercial avec un salaire inférieur ou égal à 2000€
SELECT prenom, nom, salaire FROM employes WHERE service = 'commercial' AND salaire <= 2000;
-- AND : et... (condition supplémentaire)

----------------------------------------------------------------------
-- OR 
-- Exercice : Je souhaite connaitre le prénom et noms des employés du service commercial pour un salaire de 1900 ou 2300
SELECT prenom, nom, salaire FROM employes WHERE service = 'commercial' AND (salaire = 1900 OR salaire = 2300);

---------------------------------------------------------------------
-- GROUP BY 
-- Affichage du nombre d'employés par service
SELECT service, COUNT(*) AS 'nombre' FROM employes GROUP BY service;
-- GROUP BY permet d'effectuer des regroupements

---------------------------------------------------------------------
-- REQUETE D'INSERTION
-- ID auto incrémenté : 
INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire)VALUES('Grégory', 'Lacroix', 'm', 'informatique', '2017-01-01', '10000');
-- Insertion avec choix de l'ID :
INSERT INTO employes(id_employes, prenom, nom, sexe, service, date_embauche, salaire)VALUES(877,'Grégory', 'Lacroix', 'm', 'informatique', '2017-01-01', '10000');

----------------------------------------------------------------------
-- REQUETE DE MODIFICATION
UPDATE employes SET salaire = 1100, service = 'nettoyage' WHERE  id_employes = 350;

REPLACE INTO employes(id_employes, prenom, nom, sexe, service, date_embauche, salaire)VALUES(592, 'Laura', 'Blanchet', 'm', 'cuisine', '2017-01-01', 1100); -- Si l'ID n'est pas trouvé, REPLACE se comporte comme un INSERT sinon il se comporte comme un UPDATE

SELECT * FROM employes; -- on observe le contenu de la table après les modifications

----------------------------------------------------------------------
-- REQUETE DE SUPPRESSION
DELETE FROM employes WHERE prenom = 'Jean-pierre'; -- suppression de l'employé ayant le prénom "Jean-Pierre"
DELETE FROM employes WHERE id_employes = 350; -- suppression de l'employé ayant l'ID 350

-- Supprimer tout les informaticiens sauf id_employes 701
DELETE FROM employes WHERE service = 'informatique' AND id_employes != 701; 

----------------------------------------------------------------------
-- EXERCICE :
-- 1. Afficher la profession de l'employé 547
-- 2. Afficher la date d'embauche d'Amandine
-- 3. Afficher le nom de famille de Guillaume
-- 4. Afficher le nombre d'employés ayant un n°id employes commencant par le chiffre 5
-- 5. Afficher le nombre de commerciaux
-- 6. Afficher le salaire moyen des informaticiens (+ arrondi)
-- 7. Afficher les 5 premiers employes aprés avoir classé leur noms de famille par ordre alphabétique
-- 8. Afficher le cout des commerciaux sur une année
-- 9. Afficher le salaire moyen par service (service + salaire moyen)
-- 10. Afficher le nombre de recrutement sur l'anne 2010 (+ alias)
-- 11. Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2005 à 2007
-- 12. afficher le nombre de service différent
-- 13. Afficher tous les employes (sauf ceux du service production et secrétariat)
-- 14. Afficher conjoitement le nombre d'homme et de femme dans l'entreprise
-- 15. Afficher les commerciaux ayant été recruté avant 2005 de sexe masculin et gagnant un salaire supérieur à 2500€
-- 16. Qui a été embauché en dernier? 
-- 17. Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé
-- 18. Afficher le prénom de l'informaticien gagnant le meilleur salaire
-- 19. Afficher le prenom de l'informaticien ayant été recruté en premiers
-- 20. Augmenter chaque employé de 100€
-- 21. Supprimer les employés du service commercial   
 


















