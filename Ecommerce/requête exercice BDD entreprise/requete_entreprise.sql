CREATE DATABASE nom_de_la_base; -- Cr�er une nouvelle Base de donn�es

SHOW DATABASES; -- permet de voir les bases de donn�es

USE nom_de_la_base; -- selectionner et utiliser la base de donn�es

DROP DATABASE nom_de_la_base; -- supprimer une base de donn�es

DROP table nom_de_la_table; -- supprimer une table 

TRUNCATE nom_de_la_table; -- vider la table

--------------------------------------------------------
-- REQUETE DE SELECTION

-- AFFICHAGE COMPLET 
SELECT id_employes, prenom, nom, sexe, service, date_embauche, salaire FROM employes;

SELECT * FROM employes; -- affichage de la table employes avec le raccourci de l'�toile "*" pour dire "ALL"
-- affiche-moi [* toutes les colonnes] de [la table employes]

-----------------------------------------------------------------

-- Quels sont les noms et prenom des employes travaillant dans l'entreprise ?
SELECT nom, prenom FROM employes;

-----------------------------------------------------------------

-- Quels sont les diff�rents service occup�e par les employ�s travaillant dans l'entreprise ?
SELECT service FROM employes;

----------------------------------------------------------------
-- DISTINCT
-- Affichage des services diff�rents 
SELECT DISTINCT service FROM employes;
-- DISTINCT permet d'�liminer les doublons

----------------------------------------------------------------
-- Condition WHERE
-- Affichage des employes du service informatique
SELECT nom, prenom, service FROM employes WHERE service = 'informatique';
-- WHERE = � condition que
-- WHERE [colonne = valeur]

----------------------------------------------------------------
-- BETWEEN
-- Affichage des employes ayant �t� recrut�s entre 2010 et aujourd'hui
SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2017-04-11'; 

SELECT CURDATE(); -- affiche la date du jour
SELECT NOW(); -- affiche la date du jour 

SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND CURDATE(); 
-- BETWEEN + AND = entre ... et ...
-- Pas de difference entre les quotes ' et les guillemets ". Quand il y a une valeur il faut mettre les guillemets " ou les quotes ', en revanche quand il s'agit d'un chiffre, on ne doit pas les mettre

-----------------------------------------------------------------
-- LIKE : valeur approchante
-- Affichage des employes ayant un prenom commen�ant par la lettre 's'
SELECT prenom FROM employes WHERE prenom LIKE 's%'; -- Je souhaite connaitre le prenom des personnes commen�ant par la lettre "s"

SELECT prenom FROM employes WHERE prenom LIKE '%s'; -- Je souhaite connaitre le prenom des personnes finissant par la lettre "s"

SELECT prenom FROM employes WHERE prenom LIKE '%-%'; -- Je souhaite connaitre le prenom des personnes de l'entreprise qui contient un trait d'union dans leur pr�nom

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
SELECT * FROM employes WHERE service != 'informatique'; -- Je souhaite connaitre le nom et pr�nom de tous les employes de l'entreprise NE travaillant PAS dans le service informatique
-- != diff�rent de ...

-- OPERATEURS DE COMPARAISON 
-- = 	"est �gal"
-- > 	"strictement sup�rieur"
-- < 	"strictement inf�rieur"
-- >= 	"inf�rieur ou �gal �"
-- <= 	"sup�rieur ou �gal �"
-- <> ou != 	"diff�rent de"

--------------------------------------------------------------------
-- Afficher le nom, prenom, service et salaire des employes de l'entreprise ayant un salaire sup�rieur � 3000�
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;

--------------------------------------------------------------------
-- ORDER BY
-- Affichage des employes dans l'ordre alphab�tique
SELECT prenom FROM employes ORDER BY prenom ASC;
SELECT prenom FROM employes ORDER BY prenom;
SELECT prenom FROM employes ORDER BY prenom DESC;
SELECT prenom, salaire FROM employes ORDER BY salaire DESC;
-- ORDER BY permet d'effectuer un classement
-- ASC : Ascendant croissant
-- DESC : Descendant d�croissant

---------------------------------------------------------------------
-- LIMIT 
-- Affichage des employes 3 par 3
SELECT prenom, nom FROM employes ORDER BY prenom LIMIT 0,3; 
-- LIMIT 0,3 : 0 est la position de d�part de mon tableau et 3 est le nombre d'employ�s que je souhaite afficher 

---------------------------------------------------------------------
-- Affichage des employes avec un salaire annuel
SELECT prenom, salaire*12 FROM employes;
SELECT prenom, salaire*12 AS 'Salaire annuel' FROM employes;
-- AS : Alias

---------------------------------------------------------------------
-- SUM
-- Affichage de la "masse salariale" sur 12 mois
SELECT SUM(salaire*12) AS 'masse salariale sur 1 ann�e' FROM employes;
-- SUM : Somme

---------------------------------------------------------------------
-- AVG
-- affichage du salaire moyen
SELECT AVG(salaire) AS 'Salaire moyen' FROM employes;
-- AVG : moyenne
-- ROUND
SELECT ROUND(AVG(salaire)) AS 'Salaire moyen' FROM employes;
SELECT ROUND(AVG(salaire),2) AS 'Salaire moyen' FROM employes;
-- ROUND permet d'arrondir ROUND(...,2) le 2 permet d'afficher un chiffre arrondi � 2 chiffres apr�s la virgule

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
-- requete d�taill�e : 
SELECT prenom, salaire FROM employes WHERE salaire = 1390; 
SELECT * FROM employes WHERE salaire = 1390;
SELECT prenom, salaire FROM employes ORDER BY salaire LIMIT 0,1;

--------------------------------------------------------------------
-- IN 
-- Je souhaite connaitre le pr�nom des employes travaillant dans le service comptabilit� et le service informatique
SELECT prenom, service FROM employes WHERE service IN('informatique','comptabilite');
-- IN permet de selctionner plusieurs valeurs
-- = permet de selectionner une seule valeur
 
---------------------------------------------------------------------
-- NOT
-- Je souhaite connaitre le pr�nom des employes ne travaillant pas dans les services informatique et comptabilit�
SELECT prenom, service FROM employes WHERE service NOT IN('informatique','comptabilite');

-- A l'inverse, pour connaitre le pr�nom des employes ne faisant pas partie des services comptabilit� et informatique, class� par service
SELECT prenom, nom, service FROM employes WHERE service NOT IN('informatique','comptabilite') ORDER BY service;

---------------------------------------------------------------------
-- Exercice : Je souhaite connaitre le prenom et le nom des employes du service commercial avec un salaire inf�rieur ou �gal � 2000�
SELECT prenom, nom, salaire FROM employes WHERE service = 'commercial' AND salaire <= 2000;
-- AND : et... (condition suppl�mentaire)

----------------------------------------------------------------------
-- OR 
-- Exercice : Je souhaite connaitre le pr�nom et noms des employ�s du service commercial pour un salaire de 1900 ou 2300
SELECT prenom, nom, salaire FROM employes WHERE service = 'commercial' AND (salaire = 1900 OR salaire = 2300);

---------------------------------------------------------------------
-- GROUP BY 
-- Affichage du nombre d'employ�s par service
SELECT service, COUNT(*) AS 'nombre' FROM employes GROUP BY service;
-- GROUP BY permet d'effectuer des regroupements

---------------------------------------------------------------------
-- REQUETE D'INSERTION
-- ID auto incr�ment� : 
INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire)VALUES('Gr�gory', 'Lacroix', 'm', 'informatique', '2017-01-01', '10000');
-- Insertion avec choix de l'ID :
INSERT INTO employes(id_employes, prenom, nom, sexe, service, date_embauche, salaire)VALUES(877,'Gr�gory', 'Lacroix', 'm', 'informatique', '2017-01-01', '10000');

----------------------------------------------------------------------
-- REQUETE DE MODIFICATION
UPDATE employes SET salaire = 1100, service = 'nettoyage' WHERE  id_employes = 350;

REPLACE INTO employes(id_employes, prenom, nom, sexe, service, date_embauche, salaire)VALUES(592, 'Laura', 'Blanchet', 'm', 'cuisine', '2017-01-01', 1100); -- Si l'ID n'est pas trouv�, REPLACE se comporte comme un INSERT sinon il se comporte comme un UPDATE

SELECT * FROM employes; -- on observe le contenu de la table apr�s les modifications

----------------------------------------------------------------------
-- REQUETE DE SUPPRESSION
DELETE FROM employes WHERE prenom = 'Jean-pierre'; -- suppression de l'employ� ayant le pr�nom "Jean-Pierre"
DELETE FROM employes WHERE id_employes = 350; -- suppression de l'employ� ayant l'ID 350

-- Supprimer tout les informaticiens sauf id_employes 701
DELETE FROM employes WHERE service = 'informatique' AND id_employes != 701; 

----------------------------------------------------------------------
-- EXERCICE :
-- 1. Afficher la profession de l'employ� 547
-- 2. Afficher la date d'embauche d'Amandine
-- 3. Afficher le nom de famille de Guillaume
-- 4. Afficher le nombre d'employ�s ayant un n�id employes commencant par le chiffre 5
-- 5. Afficher le nombre de commerciaux
-- 6. Afficher le salaire moyen des informaticiens (+ arrondi)
-- 7. Afficher les 5 premiers employes apr�s avoir class� leur noms de famille par ordre alphab�tique
-- 8. Afficher le cout des commerciaux sur une ann�e
-- 9. Afficher le salaire moyen par service (service + salaire moyen)
-- 10. Afficher le nombre de recrutement sur l'anne 2010 (+ alias)
-- 11. Afficher le salaire moyen appliqu� lors des recrutements sur la p�riode allant de 2005 � 2007
-- 12. afficher le nombre de service diff�rent
-- 13. Afficher tous les employes (sauf ceux du service production et secr�tariat)
-- 14. Afficher conjoitement le nombre d'homme et de femme dans l'entreprise
-- 15. Afficher les commerciaux ayant �t� recrut� avant 2005 de sexe masculin et gagnant un salaire sup�rieur � 2500�
-- 16. Qui a �t� embauch� en dernier? 
-- 17. Afficher les informations sur l'employ� du service commercial gagnant le salaire le plus �lev�
-- 18. Afficher le pr�nom de l'informaticien gagnant le meilleur salaire
-- 19. Afficher le prenom de l'informaticien ayant �t� recrut� en premiers
-- 20. Augmenter chaque employ� de 100�
-- 21. Supprimer les employ�s du service commercial   
 


















