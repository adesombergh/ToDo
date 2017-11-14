let mainPane = document.getElementById('main-pane');
let sidePane = document.getElementById('side-pane');
let mainFoot = document.getElementById('main-foot');
let sideFoot = document.getElementById('side-foot');


App = {
	config : {
		ajaxUrl : '/Todo/core/request.php'
	},
	data : [],

	record(data){
		this.data = data;
	},

	getTasks(){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", this.config.ajaxUrl, true);
		ajax.send();
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				App.record(JSON.parse(this.responseText));
				App.renderTasks();
			}

		};
	},

	renderTasks(){
		// Le template contient l'html de base de chaque LI.
		let template = document.querySelector('.template');
		//Boucle dans toutes les tâches
		for (var i = 0; i < this.data.length; i++) {
			// Pour faciliter
			let task = this.data[i];
			// Determine la section de la tache actuelle
			let section = task.task_ended_on==null?'todo':(task.task_ended_on<task.task_end?'done':'late');
			// Clone le template et enlève la class template
			let clone = template.cloneNode(true);
			clone.classList.remove('template');

			// Crée un identifiant unique pour chaque tache (afin de faciliter la TREE TRAVERSIAL)
			let uniqueID = "ti"+task.task_id;
			clone.setAttribute("id", uniqueID);

			// AJOUT Text / Data-Toggle / Click AU TITRE DE CHAQUE TACHE
			clone.querySelector('.task-name').innerHTML = task.task_title;
			clone.querySelector('.task-name').setAttribute('data-toggle', uniqueID);
			clone.querySelector('.task-name').addEventListener('click',this.onTaskTitleClick);
			// AJOUT Text / Data-Toggle / Click AU TITRE DE CHAQUE TACHE
			clone.querySelector('.delete-task').setAttribute('data-delete', uniqueID);
			clone.querySelector('.delete-task').addEventListener('click',this.onTaskDeleteClick);
			// Ajout Description
			clone.querySelector('.desc').innerHTML = task.task_description;
			// Ajout Date de Création
			clone.querySelector('.created').innerHTML = task.task_created_on;
			
			// Ajout du clone dans la section voulu
			document.getElementById(section).appendChild(clone);
		}
	},

	startDatePickers(){
		this.startedat = new MtrDatepicker({
		  target: "startedat",
		  disableAmPm: true
		});
		this.theend = new MtrDatepicker({
		  target: "theend",
		  disableAmPm: true
		});
	},

	startPageBehaviors(){
		this.formSubmitter();
		this.eventHandlers();
	},
	eventHandlers(){
		// CLICK SUR LE BOUTON (+)
		document.getElementById('plus').addEventListener('click',function(e){
			e.preventDefault();
			sidePane.classList.toggle('hide');
			sideFoot.classList.toggle('hide');
			mainPane.classList.toggle('hide');
			mainFoot.classList.toggle('hide');
			document.querySelector('.add-button').classList.toggle('chosen');
		});
	},
	onTaskDeleteClick(e){
		// CLICK SUR LE BOUTON DELETE
		e.preventDefault();
		var ajax = new XMLHttpRequest();
		ajax.open("POST", this.config.ajaxUrl, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		return;
		var req = "action=delete&task_id="+this.dataset.delete.split('ti')[1];
		ajax.send(req);
		ajax.onreadystatechange = function() {
		  	if (ajax.readyState == 4 && ajax.status == 200) {
				var data = ajax.responseText;
				console.log(data);
			}
		}
		document.getElementById(this.dataset.delete).parentElement.removeChild(document.getElementById(this.dataset.delete));
	},
	onTaskTitleClick(e){
		e.preventDefault();
		let detail = document.querySelector("#" + this.dataset.toggle + " .details");
		let actions = document.querySelector("#" + this.dataset.toggle + " .task-actions");
		detail.classList.toggle('hide');
		actions.classList.toggle('hide');
	},
	formSubmitter(){
		document.getElementById('saveTask').addEventListener('click',(e)=>{
			e.preventDefault();
			let title = document.getElementById('title').value;
			let description = document.getElementById('description').value;
			let start = this.startedat.values.timestamp/1000;
			let deadline = this.theend.values.timestamp/1000;


			var ajax = new XMLHttpRequest();
			ajax.open("POST", this.config.ajaxUrl, true);
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var req = "task_title="+title+"&task_description="+description+"&task_created_on="+ start +"&task_end="+ deadline;
			ajax.send(req);
			ajax.onreadystatechange = function() {
			  	if (ajax.readyState == 4 && ajax.status == 200) {
					var data = ajax.responseText;
					console.log(data);
				}
			}
		});
	},
	start(){
		this.getTasks();
		this.startPageBehaviors();
		this.startDatePickers();
	}
}

App.start();
