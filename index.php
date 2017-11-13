<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>ToDo List</title>
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="main">
			<div class="main-header">
				<div class="add-button chosen"><a href="#" id="plus">+</a></div>
				<h1>MY TODOLIST</h1>
			</div>
			<div id="main-pane" class="main-container">


				<ul class="task-list" id="done">
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Take a shower</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Make my bag</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Take a breakfast</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
				</ul>


				<ul class="task-list" id="todo">
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Go to Bus Stop</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Be at becode at 9:00</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li class="task-item">
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Start Coding</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">I need a real break</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
				</ul>
			
				<ul class="task-list" id="late">
					<li class="task-item">
						<div class="task">
							<span class="task-heading">
								<a href="#check" class="task-check"></a>
								<a href="#details" class="task-name">Finish this app</a>
							</span>
							<ul class="task-actions">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Delete</a></li>
							</ul>
						</div>
						<div class="details">
							<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quas asperiores.</p>
							<p class="time-info">Started on: <span class="created">date</span>, End time: <span class="completed">date</span></p>
						</div>
					</li>
				</ul>

			</div>
			<div id="side-pane" class="next-container hide">
				<div class="clear">
					<a href="#clear">Clear</a>
				</div>
				<div class="form">
					<form action="">
						<h3>TITLE</h3>
						<input class="input" id="title" name="title" type="text" placeholder="My todo title">
						<h3>DESCRIPTION</h3>
						<textarea class="input" id="description" name="description" rows="4" placeholder="My todo description"></textarea>
						<h3>STARTED AT</h3>
						<input class="input" id="started_at" name="started_at" type="text" placeholder="December 12, 2 pm">
						<h3>ENDED AT</h3>
						<input class="input" id="started_at" name="started_at" type="text" placeholder="December 12, 2 pm">
					</form>
				</div>

			</div>
			<div class="main-footer">
				<ul class="hide">
					<li class="actif"><a href="#all">All tasks</a></li>
					<li><a href="#todo">Todo Tasks</a></li>
					<li><a href="#done">Done Tasks</a></li>
				</ul>
				<ul>
					<li><a href="#save">Save Task</a></li>
					<li><a href="#saveandadd">Save &amp; Add Taks</a></li>
				</ul>
			</div>
		</div>

		<script src="script.js"></script>
	</body>
</html>