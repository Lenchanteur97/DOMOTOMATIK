<?php

/*Connexion BDD*/
try{$bdd = new PDO('mysql:host=localhost;port=8889;dbname=bdd_5e;charset=utf8', 'root', 'root');}
catch (Exception $e){die('Erreur : '.$e->getMessage());}


/*Récupération de l'id de l'utilisateur et de sa maison*/
$iduser = $_SESSION['id_personne'];
$idmaison = $_SESSION['id_maison'];
$nompiece = $_SESSION['choix_piece'];

/*Requête préalable : obtention de l'id de la pièce choisie*/

$req = $bdd->query("SELECT id_piece FROM piece WHERE id_maison = '$idmaison' AND nom_de_piece = '$nompiece'");
$res = $req->fetch();
$idpiece = $res['id_piece'];

/*La formulation de la requête et son affichage*/
$requete = $bdd->query("SELECT * FROM capteur WHERE id_piece = '$idpiece'");
$donnees = $requete->fetchAll();

$a=0;
$types=[];
$valeurs=[];

foreach ($donnees as $donnee):
    {
        $types[] = $donnee['type'];
        //echo $donnee['type']." ";
        $valeurs[] = $donnee['valeur_temps_reel'];
        //echo '</br>';
        $a+=1;
    }
endforeach;

/*echo '<pre>';
print_r($types);
echo '</pre>';

echo '<pre>';
print_r($valeurs);
echo '</pre>';*/

$nb_lignes=floor($a/3);
$nb_seuls=$a%3;

/*echo '</br>';
echo $a." capteurs :";
echo '</br>';
echo $nb_lignes." ligne(s) de 3 capteurs + ";
echo $nb_seuls." capteur(s) seul(s).";
echo '</br></br>';*/

$_SESSION['types']=$types;
$_SESSION['valeurs']=$valeurs;
$_SESSION['nb_lignes']=$nb_lignes;
$_SESSION['nb_seuls']=$nb_seuls;

?>
