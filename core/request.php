<?php 
// Fichier   request   en   php   (request.php)   qui   comprendra   vos   fonctions d'appel   à   la   base   de   données.   Et   dans   lequel   seront   inclus   dans   l'ordre: config.php   et   connexion.php.   Je   vous   invite   à   revoir   comment   on   a   fait pour   inclure   des   fichiers   php.   Vous   ferez   juste   un   var_dump   pour vérifier   que   vous   récupérez   bien   les   bonnes   données.   On   reviendra   sur ce   fichier   plus   tard   lors   de   la   mise   en   place   de   la   communication   en AJAX.
include_once 'config.php';
include_once 'connexion.php';


if (isset($_POST['title'],$_POST['description'],$_POST['task_created_on'],$_POST['task_end'])) {
	addTaskTo($bdd);
}





$searches = array(
	array(
		"filter" => "todo",
		"request" => ' WHERE `task_ended_on` IS NULL'
	),
	array(
		"filter" => "done",
		"request" => ' WHERE `task_ended_on` IS NOT NULL AND `task_ended_on` < `task_end`'
	),
	array(
		"filter" => "late",
		"request" => ' WHERE `task_ended_on` IS NOT NULL AND `task_ended_on` > `task_end`'
	)
);

$filterBy = "";
if ( isset($_GET['filter']) && !empty($_GET['filter']) ) {
	$filterBy = $_GET['filter'];
	if ($filterBy == "todo") {
		unset($searches[1],$searches[2]);
	} elseif ($filterBy == "done") {
		unset($searches[0]);
	}
}


$results  = queryDb($searches,$bdd);





function addTaskTo($bdd)
{
	$sql = "INSERT INTO tasks (task_title, task_description, task_created_on, task_end) VALUES (:title, :description, :created, :deadline);";

	$sth = $bdd->prepare($sql);

	try {
		$sth->execute(array(
			"title" => $_POST['title'],
			"description" => $_POST['description'],
			"created" => $_POST['task_created_on'],
			"deadline" => $_POST['task_end']
		));
	} catch (Exception $e) {
		return $e;
	}
	return "sucess";
}

function queryDb($searches,$bdd)
{
	$results = array();
	foreach ($searches as $search) {
		$sql = 'SELECT * FROM tasks' . $search['request'];
		$sth = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$results[$search['filter']] = $sth->fetchAll();
	}
	return $results;
}



 ?>