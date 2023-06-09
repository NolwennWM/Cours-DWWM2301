-- Récupérer la BDD dans les ressources.
--  1. Quels sont les tickets qui comportent l’article d’ID 500, afficher le numéro de  ticket uniquement ? (24 résultats attendus)
SELECT NUMERO_TICKET FROM ventes WHERE ID_ARTICLE = 500;

--  2. Afficher les tickets du 15/01/2014. (1 résultat attendu)
SELECT NUMERO_TICKET FROM ticket WHERE DATE_VENTE = "2014-01-15"

--  3. Afficher les tickets émis du 15/01/2014 au 17/01/2014.(4 résultats attendus)
SELECT DATE_VENTE FROM ticket WHERE DATE_VENTE BETWEEN "2014-01-15" AND "2014-01-17";

--  4. Afficher la liste des articles apparaissant à 50 et plus exemplaires sur un ticket.(1090 résultats attendus)
SELECT DISTINCT ID_ARTICLE  FROM ventes WHERE QUANTITE >= 50;

--  5. Quelles sont les tickets émis au mois de mars 2014.(78 résultats attendus)
SELECT * FROM ticket WHERE DATE_VENTE BETWEEN "2014-03-01" AND "2014-03-31";
SELECT * FROM ticket WHERE DATE_VENTE LIKE "2014-03%";
SELECT * FROM ticket WHERE month(DATE_VENTE) = "03" AND ANNEE = 2014;

--  6. Quelles sont les tickets émis entre les mois de mars et avril 2014 ? (166 résultats attendus)
SELECT * FROM ticket WHERE DATE_VENTE LIKE "2014-03%" OR DATE_VENTE LIKE "2014-04%";

--  7. Quelles sont les tickets émis au mois de mars et juin 2014 ? (174 résultats attendus)
SELECT * FROM ticket WHERE DATE_VENTE BETWEEN '2014-03-01' AND "2014-03-31" UNION SELECT * FROM ticket WHERE DATE_VENTE BETWEEN '2014-06-01' AND "2014-06-31";

SELECT * FROM ticket WHERE MONTH(DATE_VENTE) IN ("03", "06") AND YEAR(DATE_VENTE) = "2014";

--  8. Afficher l’id et le nom des bières classée par couleur. (3922 résultats attendus, vous pouvez afficher la couleur pour vérifier votre résultat)
SELECT c.NOM_COULEUR, a.NOM_ARTICLE FROM couleur c RIGHT JOIN article a ON c.ID_COULEUR = a.ID_COULEUR ORDER BY NOM_COULEUR;

SELECT ID_COULEUR, ID_ARTICLE, NOM_ARTICLE FROM article ORDER BY ID_Couleur;

--  9. Afficher l’id et le nom des bières n’ayant pas de couleur. (706 résultats attendus)
SELECT couleur.ID_COULEUR, article.NOM_ARTICLE FROM article LEFT JOIN couleur ON article.ID_COULEUR = couleur.ID_COULEUR WHERE NOM_COULEUR IS NULL;

SELECT ID_ARTICLE, NOM_ARTICLE FROM article WHERE ID_COULEUR IS NULL;

--  10. Lister pour chaque ticket la quantité totale d’articles vendus classée par quantité décroissante. (4502 résultats attendus)
SELECT NUMERO_TICKET, SUM(QUANTITE) AS total FROM ventes GROUP BY NUMERO_TICKET ORDER BY total DESC;

--  11. Lister chaque ticket pour lequel la quantité totale d’articles vendus est supérieure
--  à 500 classée par quantité décroissante.(1026 résultats attendus)
SELECT NUMERO_TICKET, SUM(QUANTITE) AS total FROM ventes GROUP BY NUMERO_TICKET HAVING total > 500 ORDER BY total DESC;

--  12. Lister chaque ticket pour lequel la quantité totale d’articles vendus est supérieure
--  à 500 classée par quantité décroissante.On exclura du total,
--  les ventes ayant une quantité supérieure à 50  (1021 résultats attendus)
SELECT NUMERO_TICKET, ID_ARTICLE, SUM(QUANTITE) FROM ventes WHERE NOT QUANTITE > 50 GROUP BY NUMERO_TICKET HAVING sum(QUANTITE) > 500 ORDER BY SUM(QUANTITE) DESC;

SELECT NUMERO_TICKET, ID_ARTICLE, SUM(QUANTITE) as total FROM ventes WHERE QUANTITE <= 50 GROUP BY NUMERO_TICKET HAVING total > 500 ORDER BY total DESC;

--  13. Lister l'id, le nom de la bière, le volume et le titrage des bières de type ‘Trappiste’. (48 résultats attendus.)
SELECT ID_ARTICLE, NOM_ARTICLE, VOLUME, TITRAGE FROM article WHERE ID_TYPE = (SELECT ID_TYPE FROM type WHERE NOM_TYPE = "Trappiste");

SELECT ID_ARTICLE, NOM_ARTICLE, VOLUME, TITRAGE FROM article INNER JOIN type ON article.ID_TYPE = type.ID_TYPE WHERE NOM_TYPE = "Trappiste";

SELECT ID_ARTICLE, NOM_ARTICLE, VOLUME, TITRAGE FROM article INNER JOIN type USING(ID_TYPE) WHERE NOM_TYPE = "Trappiste";

--  14. Lister les marques de bières du continent ‘Afrique’ (3 résultats attendus)
SELECT NOM_MARQUE, NOM_CONTINENT 
FROM marque INNER JOIN pays on pays.ID_PAYS = marque.ID_PAYS INNER JOIN continent ON continent.ID_CONTINENT = pays.ID_CONTINENT WHERE NOM_CONTINENT = "Afrique";

--  15. Lister les bières du continent ‘Afrique’ (6 résultats attendus)
SELECT NOM_ARTICLE FROM article a INNER JOIN marque m USING(ID_MARQUE) INNER JOIN pays p USING(ID_PAYS) INNER JOIN continent c USING(ID_CONTINENT) WHERE NOM_CONTINENT = "Afrique";

--  16. Lister les tickets (année, numéro de ticket, montant total payé). En sachant que le
--  prix de vente est égal au prix d’achat augmenté de 15% et que l’on n’est pas
--  assujetti à la TVA. (8263 résultats attendus avec pour les tickets 1, 2 et 3 des totaux égaux à "601.40", "500.05" et "513.33")
SELECT v.ANNEE, v.NUMERO_TICKET, ROUND(SUM(QUANTITE*a.PRIX_ACHAT*1.15), 2) FROM ventes v INNER JOIN article a ON v.ID_ARTICLE = a.ID_ARTICLE GROUP BY v.ANNEE, v.NUMERO_TICKET;

--  17. Donner le C.A. par année. (3 résultats attendus : 
-- 2014: "585092.90", 2015: "1513659.30", 2016: "2508155.68")
SELECT ANNEE, ventes.ID_ARTICLE, ROUND(SUM(QUANTITE*PRIX_ACHAT*1.15), 2) FROM ventes INNER JOIN article ON article.ID_ARTICLE = ventes.ID_ARTICLE GROUP BY ANNEE;

--  18. Lister les quantités vendues de chaque article pour l’année 2016. (1960 résultats attendues (ou 3922))
SELECT ID_ARTICLE, SUM(QUANTITE) FROM ventes WHERE ventes.ANNEE = "2016" GROUP BY ID_ARTICLE;

--  19. Lister les quantités vendues de chaque article pour les années 2014,2015 ,2016. (5838 résultats attendus (ou 11197))
SELECT ID_ARTICLE, ANNEE, SUM(QUANTITE) AS quantite_vendu FROM ventes WHERE ANNEE BETWEEN 2014 AND 2016 GROUP BY ID_ARTICLE, ANNEE;

--  20. Lister les articles qui n’ont fait l’objet d’aucune vente en 2014. (498 résultats attendus (Ou 540))
SELECT ID_ARTICLE, NOM_ARTICLE FROM article WHERE ID_ARTICLE NOT IN (SELECT ID_ARTICLE FROM ventes WHERE ANNEE = 2014)
GROUP BY ID_ARTICLE;

--  21. Coder de 3 manières différentes la requête suivante :
--  Lister les pays qui fabriquent des bières de type ‘Trappiste’. (3 résultats attendus)
SELECT DISTINCT p.ID_PAYS, p.NOM_PAYS FROM pays p INNER JOIN marque ON marque.ID_PAYS = p.ID_PAYS INNER JOIN article ON article.ID_MARQUE = marque.ID_MARQUE INNER JOIN type ON article.ID_TYPE = type.ID_TYPE WHERE NOM_TYPE = "Trappiste";

SELECT NOM_PAYS FROM pays p 
LEFT JOIN marque m USING(ID_PAYS) 
LEFT JOIN article a USING(ID_MARQUE) 
WHERE a.ID_TYPE = (
    SELECT ID_TYPE FROM type WHERE NOM_TYPE = "Trappiste") 
GROUP BY NOM_PAYS;

SELECT NOM_PAYS
FROM pays p
LEFT JOIN marque m ON m.ID_PAYS = p.ID_PAYS
LEFT JOIN article a ON m.ID_MARQUE = a.ID_MARQUE
LEFT JOIN type t ON t.ID_TYPE = a.ID_TYPE
WHERE t.NOM_TYPE = "Trappiste"
GROUP BY NOM_PAYS;

--  22. Lister les tickets sur lesquels apparaissent un des articles apparaissant aussi sur
--  le ticket 2014-856. (38 résultats attendus)
SELECT NUMERO_TICKET FROM ventes WHERE ID_ARTICLE IN (SELECT ID_ARTICLE FROM ventes WHERE NUMERO_TICKET = 856 AND ANNEE = 2014);

--  23. Lister les articles ayant un degré d’alcool plus élevé que la plus forte des
--  trappistes. (74 résultats attendus)
SELECT ID_ARTICLE, NOM_ARTICLE, TITRAGE FROM article WHERE TITRAGE > (SELECT MAX(TITRAGE) FROM article WHERE ID_TYPE = (SELECT ID_TYPE FROM type WHERE NOM_TYPE = "Trappiste"));

--  24. Afficher les quantités vendues pour chaque couleur en 2014.
-- (5 résultats attendus : Blonde	"72569", Brune	"49842"	,
-- NULL	"36899", Ambrée	31427, Blanche	14416	)
SELECT c.NOM_COULEUR, SUM(v.QUANTITE) FROM ventes v INNER JOIN article a ON v.ID_ARTICLE = a.ID_ARTICLE LEFT JOIN couleur c ON a.ID_COULEUR = c.ID_COULEUR WHERE v.ANNEE = 2014 GROUP BY NOM_COULEUR ORDER BY QUANTITE;

--  25. Donner pour chaque fabricant, le nombre de tickets sur lesquels apparait un de
--  ses produits en 2014. (11 résultats attendus dont 7383 sans NULL)
SELECT count(t.NUMERO_TICKET) as TOTAL, f.NOM_FABRICANT 
FROM ticket t
LEFT JOIN ventes v ON t.ANNEE = v.ANNEE AND t.NUMERO_TICKET = v.NUMERO_TICKET
LEFT JOIN article a ON a.ID_ARTICLE = v.ID_ARTICLE
LEFT JOIN marque m ON a.ID_MARQUE = m.ID_MARQUE
LEFT JOIN fabricant f ON f.ID_FABRICANT = m.ID_FABRICANT
WHERE t.ANNEE = 2014
GROUP BY f.NOM_FABRICANT
ORDER BY f.NOM_FABRICANT;

-- 26. Donner l’ID, le nom, le volume et la quantité vendue des 20 articles les plus  vendus en 2016. 
--(résultats allant de l'id "3192" avec 597 ventes à l'id "3789" avec 488 ventes)
SELECT a.ID_ARTICLE, a.NOM_ARTICLE, a.VOLUME, SUM(v.QUANTITE) as total
FROM article a
LEFT JOIN ventes v USING(ID_ARTICLE)
WHERE v.ANNEE = 2016
GROUP BY a.ID_ARTICLE, a.NOM_ARTICLE, a.VOLUME
ORDER BY total DESC
LIMIT 20;

--  27. Donner l’ID, le nom, le volume et la quantité vendue des 5 ‘Trappistes’ les plus vendus en 2016.
-- (résultats allant de l'id "3588" avec 502 ventes à l'id "2104" avec 357 ventes)
SELECT a.ID_ARTICLE, a.NOM_ARTICLE, a.VOLUME, SUM(v.QUANTITE) as total
FROM article a
LEFT JOIN ventes v USING(ID_ARTICLE)
INNER JOIN type t USING(ID_TYPE)
WHERE v.ANNEE = 2016 AND t.NOM_TYPE = "Trappiste"
GROUP BY a.ID_ARTICLE, a.NOM_ARTICLE, a.VOLUME
ORDER BY total DESC
LIMIT 5;

--  28. Donner l’ID, le nom, le volume et les quantité vendues en 2015 et 2016, des
--  bières dont les ventes ont été stables. (moins de 1% de variation)
-- (29 résultats attendus)
SELECT ID_ARTICLE, NOM_ARTICLE, VOLUME, 
    (SELECT SUM(QUANTITE) FROM ventes WHERE ID_ARTICLE = a.ID_ARTICLE AND ANNEE = 2015) as "2015",
    (SELECT SUM(QUANTITE) FROM ventes WHERE ID_ARTICLE = a.ID_ARTICLE AND ANNEE = 2016) as "2016"
    FROM article a
    WHERE ((SELECT SUM(QUANTITE) FROM ventes WHERE ID_ARTICLE = a.ID_ARTICLE AND ANNEE = 2016)
    -
    (SELECT SUM(QUANTITE) FROM ventes WHERE ID_ARTICLE = a.ID_ARTICLE AND ANNEE = 2015))
    /
    (SELECT SUM(QUANTITE) FROM ventes WHERE ID_ARTICLE = a.ID_ARTICLE AND ANNEE = 2015)*100 BETWEEN -1 AND 1 
    ORDER BY a.ID_ARTICLE;

--  29. Lister les types de bières suivant l’évolution de leurs ventes entre 2015 et 2016.
--  Classer le résultat par ordre décroissant des performances.
-- (13 résultats attendus allant de "Bio" 82.71 à "Lambic" 47.28)
SELECT ID_TYPE, NOM_TYPE,
    round(
        ((SELECT SUM(QUANTITE) FROM ventes WHERE ANNEE = 2016 AND ID_ARTICLE IN (
            SELECT ID_ARTICLE FROM article WHERE ID_TYPE = t.ID_TYPE
        ))
        -
        (SELECT SUM(QUANTITE) FROM ventes WHERE ANNEE = 2015 AND ID_ARTICLE IN (
            SELECT ID_ARTICLE FROM article WHERE ID_TYPE = t.ID_TYPE
        )))
        /
        (SELECT SUM(QUANTITE) FROM ventes WHERE ANNEE = 2015 AND ID_ARTICLE IN (
            SELECT ID_ARTICLE FROM article WHERE ID_TYPE = t.ID_TYPE
        ))*100, 2
    ) as evolution
    FROM type t
    ORDER BY evolution DESC;

--  30. Existe-t-il des tickets sans vente ? (3 résultats attendus)
SELECT ANNEE, NUMERO_TICKET
FROM ticket
WHERE concat(ANNEE, NUMERO_TICKET) NOT IN (SELECT concat(ANNEE, NUMERO_TICKET) FROM ventes);

--  31. Lister les produits vendus en 2016 dans des quantités jusqu’à -15% des quantités
--  de l’article le plus vendu. (12 résultats attendus)
SELECT a.ID_ARTICLE, NOM_ARTICLE,
    (SELECT sum(QUANTITE) FROM ventes WHERE ANNEE = 2016 AND ID_ARTICLE = a.ID_ARTICLE) as qte
    FROM article a
    WHERE (SELECT sum(QUANTITE) FROM ventes WHERE ANNEE = 2016 AND ID_ARTICLE = a.ID_ARTICLE) 
    >=
    (SELECT sum(QUANTITE) as q FROM ventes WHERE ANNEE = 2016 GROUP BY ID_ARTICLE ORDER BY q DESC LIMIT 1)* 0.85
    ORDER BY qte DESC;

--  LES BESOINS DE MISE A JOUR
--  32. Appliquer une augmentation de tarif de 10% pour toutes les bières ‘Trappistes’ de couleur ‘Blonde’ (Résultat attendu : 22 lignes modifiées)
UPDATE article
SET PRIX_ACHAT = PRIX_ACHAT * 1.1
WHERE ID_Couleur = (SELECT ID_COULEUR FROM couleur WHERE NOM_COULEUR = "Blonde")
AND ID_TYPE = (SELECT type.ID_TYPE FROM type WHERE NOM_TYPE = "Trappiste");

--  33. Mettre à jour le degré d’alcool de toutes les bières n’ayant pas cette information.
--  On y mettra le degré d’alcool de la moins forte des bières du même type et de même couleur. (6 lignes modifiées ou 28)
UPDATE article a1 SET TITRAGE = (
    SELECT MIN(TITRAGE) FROM article a2 
    WHERE a1.ID_COULEUR = a2.ID_COULEUR
    AND a1.ID_TYPE = a2.ID_TYPE
)
WHERE TITRAGE IS NULL;
-- VERSION compliqué qui prend en compte couleur et type séparé :
UPDATE article a SET TITRAGE = 
IF((SELECT MIN(TITRAGE) FROM article WHERE a.ID_COULEUR = ID_COULEUR AND a.ID_TYPE = ID_TYPE ) IS NOT NULL, 
    (SELECT MIN(TITRAGE) FROM article WHERE a.ID_COULEUR = ID_COULEUR AND a.ID_TYPE = ID_TYPE ),
    IF((SELECT MIN(TITRAGE) FROM article WHERE a.ID_TYPE = ID_TYPE) IS NOT NULL, 
    (SELECT MIN(TITRAGE) FROM article WHERE a.ID_TYPE = ID_TYPE),
    IF((SELECT MIN(TITRAGE) FROM article WHERE a.ID_COULEUR = ID_COULEUR) IS NOT NULL, 
    (SELECT MIN(TITRAGE) FROM article WHERE a.ID_COULEUR = ID_COULEUR), 
    (SELECT MIN(TITRAGE) FROM article)) ))
    WHERE TITRAGE IS NULL;

--  34. Suppression des bières qui ne sont pas des bières ! (type ‘Bière Aromatisée’) (262 lignes supprimées)
DELETE FROM article
WHERE ID_TYPE = (SELECT ID_TYPE FROM type WHERE NOM_TYPE= "Bière Aromatisée");
--  35. Supprimer les tickets qui n’ont pas de ventes.(3 lignes supprimées)
DELETE FROM article
WHERE concat(ANNEE, NUMERO_TICKET) NOT IN (SELECT concat(ANNEE, NUMERO_TICKET) from ventes);