<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>ToDo List</title>
		<link rel="stylesheet" href="vendor/mtr/mtr-datepicker.min.css">
		<!-- <link rel="stylesheet" href="vendor/mtr/mtr-datepicker.default-theme.min.css"> -->

		<link rel="stylesheet" href="vendor/mtr/mtr-datepicker.clutterboard-theme.min.css">

		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<div class="main">
			<div class="main-header">
				<div class="add-button"><a href="#" id="plus">+</a></div>
				<h1>MY TODOLIST</h1>
			</div>
			<div id="main-pane" class="main-container">
				<ul class="task-list" id="todo">
				</ul>
				<ul class="task-list" id="done">
				</ul>
				<ul class="task-list" id="late">
				</ul>
				<ul class="hide">
					<li class="task-item template">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" data-opened="false" class="task-name"></a>
							</span>
							<ul class="task-actions hide">
								<li><a href="#">End Task</a></li>
								<li><a href="#">Edit</a></li>
								<li><a href="#" class="delete-task">Delete</a></li>
							</ul>
						</div>
						<div class="details hide">
							<p class="desc"></p>
							<p class="time-info">
								Started on: <span class="created"></span> - End time: <span class="completed"></span>
							</p>
						</div>
					</li>
				</ul>
			</div>
			<div id="side-pane" class="next-container hide">
				<div class="clear">
					<a href="#clear">Clear</a>
				</div>
				<div class="form">
					<form action="" method="post" id="addform">
						<h3>TITLE</h3>
						<input class="input" id="title" name="title" type="text" placeholder="My todo title">
						<h3>DESCRIPTION</h3>
						<textarea class="input" id="description" name="description" rows="4" placeholder="My todo description"></textarea>
						<h3>STARTED AT</h3>
						<div id="startedat"></div>
						<input class="input" id="task_created_on" name="task_created_on" type="hidden">
						<h3>DEADLINE</h3>
						<div id="theend"></div>
						<input class="input" id="task_end" name="task_end" type="hidden">
					</form>
				</div>

			</div>
			<div class="main-footer">
				<ul id="main-foot">
					<li><a href="index.php">All tasks</a></li>
					<li><a href="index.php?filter=todo">Todo Tasks</a></li>
					<li><a href="index.php?filter=done">Done Tasks</a></li>
				</ul>
				<ul id="side-foot" class="hide">
					<li><a href="#save" id="saveTask">Save Task</a></li>
					<li><a href="#saveandadd" id="saveAndNew">Save &amp; Add Taks</a></li>
				</ul>
			</div>
		</div>

		<script src="vendor/mtr/mtr-datepicker.min.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>