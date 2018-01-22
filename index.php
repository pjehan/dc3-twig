<?php 

require_once 'vendor/autoload.php'; // va nous charger les classes qui sont dans le dossier vendor

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'cache' => 'cache'
));

$ch = curl_init();
$url = "https://data.rennesmetropole.fr/api/records/1.0/search/?dataset=artistes_concerts_transmusicales&facet=annee&facet=edition_rencontres_trans_musicales&facet=artistes&facet=1ere_date&facet=1ere_salle&facet=1ere_ville&facet=origines_pays_1&facet=origines_ville_1&facet=1ere_sortie_discographique";
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result, true); // permet de tout récupéerer dans des tableaux associatifs
curl_close($ch);


echo $twig->render('home.html.twig', array('name' => 'Fabien', 'concerts' => $result["records"]));