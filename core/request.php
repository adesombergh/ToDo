<?php 
// Fichier   request   en   php   (request.php)   qui   comprendra   vos   fonctions d'appel   à   la   base   de   données.   Et   dans   lequel   seront   inclus   dans   l'ordre: config.php   et   connexion.php.   Je   vous   invite   à   revoir   comment   on   a   fait pour   inclure   des   fichiers   php.   Vous   ferez   juste   un   var_dump   pour vérifier   que   vous   récupérez   bien   les   bonnes   données.   On   reviendra   sur ce   fichier   plus   tard   lors   de   la   mise   en   place   de   la   communication   en AJAX.
include_once 'config.php';
include_once 'connexion.php';

if (!empty($_POST)) {
	if (isset($_POST['action'])&&!empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'delete':
				delete()
				break;

			case 'add':
				add()
				break;

			case 'update':
				update()
				break;
		}
	}
}

function add()
{
	if (isset(
		$_POST['task_title'],
		$_POST['task_description'],
		$_POST['task_created_on'],
		$_POST['task_end']))
	{
		try {
			$result = addTaskTo($bdd);
		} catch (Exception $e) {
			return $e;
		}
		return $result;
	 }
}
function update()
{
	# code...
}
function delete()
{
	if (isset($_POST['task_id'])
	{
		try {
			$result = deleteTaskFrom($bdd);
		} catch (Exception $e) {
			return $e;
		}
		return $result;
	 }
}







// $searches = array(
// 	array(
// 		"filter" => "todo",
// 		"request" => ' WHERE `task_ended_on` IS NULL'
// 	),
// 	array(
// 		"filter" => "done",
// 		"request" => ' WHERE `task_ended_on` IS NOT NULL AND `task_ended_on` < `task_end`'
// 	),
// 	array(
// 		"filter" => "late",
// 		"request" => ' WHERE `task_ended_on` IS NOT NULL AND `task_ended_on` > `task_end`'
// 	)
// );

// $filterBy = "";
// if ( isset($_GET['filter']) && !empty($_GET['filter']) ) {
// 	$filterBy = $_GET['filter'];
// 	if ($filterBy == "todo") {
// 		unset($searches[1],$searches[2]);
// 	} elseif ($filterBy == "done") {
// 		unset($searches[0]);
// 	}
// }

echo json_encode(queryDb($bdd));






function addTaskTo($bdd)
{
	$sql = "INSERT INTO tasks (task_title, task_description, task_created_on, task_end) VALUES (:title, :description, :created, :deadline);";

	$sth = $bdd->prepare($sql);

	try {
		$sth->execute(array(
			"title" => $_POST['task_title'],
			"description" => $_POST['task_description'],
			"created" => $_POST['task_created_on'],
			"deadline" => $_POST['task_end']
		));
	} catch (Exception $e) {
		return $e;
	}
	return "sucess";
}

function deleteTaskFrom($bdd)
{
	$sql = "DELETE FROM tasks WHERE task_id=:id;";

	$sth = $bdd->prepare($sql);

	try {
		$sth->execute(array(
			"id" => $_POST['task_id']
		));
	} catch (Exception $e) {
		return $e;
	}
	return "sucess";
}

function queryDb($bdd)
{
	$sql = 'SELECT * FROM tasks';
	$sth = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute();	
	return $sth->fetchAll();
}



 ?>