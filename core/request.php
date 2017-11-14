<?php 
// Fichier   request   en   php   (request.php)   qui   comprendra   vos   fonctions d'appel   à   la   base   de   données.   Et   dans   lequel   seront   inclus   dans   l'ordre: config.php   et   connexion.php.   Je   vous   invite   à   revoir   comment   on   a   fait pour   inclure   des   fichiers   php.   Vous   ferez   juste   un   var_dump   pour vérifier   que   vous   récupérez   bien   les   bonnes   données.   On   reviendra   sur ce   fichier   plus   tard   lors   de   la   mise   en   place   de   la   communication   en AJAX.

include_once 'config.php';
include_once 'connexion.php';


$sql = 'SELECT nom, couleur, calories FROM fruit WHERE calories < :calories AND couleur = :couleur';

$sth = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$sth->execute(array(':calories' => 150, ':couleur' => 'red'));
$red = $sth->fetchAll();


 ?>