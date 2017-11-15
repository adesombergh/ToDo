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
		this.data = data.tasks;
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
		// Le template contient l'html de base de chaque Item de la Liste.
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
			// AJOUT Click sur Delete
			clone.querySelector('.delete-task').setAttribute('data-delete', uniqueID);
			clone.querySelector('.delete-task').addEventListener('click',this.onTaskDeleteClick);
			// AJOUT Click sur End
			clone.querySelector('.complete-task').setAttribute('data-complete', uniqueID);
			clone.querySelector('.complete-task').addEventListener('click',this.onTaskCompleteClick);
			// AJOUT Click sur Edit
			clone.querySelector('.edit-task').setAttribute('data-edit', uniqueID);
			clone.querySelector('.edit-task').addEventListener('click',this.onTaskEditClick);
			// Ajout Description
			clone.querySelector('.desc').innerHTML = task.task_description;
			// Ajout Date de Création
			clone.querySelector('.created').innerHTML = this.pretty(task.task_created_on);
			if (task.task_ended_on) {
				clone.querySelector('.completed').innerHTML = " - End time: "+ this.pretty(task.task_ended_on);
			}			
			// Ajout du clone dans la section voulu
			document.getElementById(section).appendChild(clone);
		}
	},
	pretty(timestamp){
		var date = new Date(timestamp*1000);
		return date.getDate()+"/"+date.getMonth()+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes();
	},
	startDatePickers(){
		this.thestart = new DateTimePicker('#thestart', {
			timePicker: true,
			timePickerFormat:24,
			format: 'd/m/Y à H:i',
			allowEmpty:true,
			minuteIncrement:15,
			positionOffset: {x:0,y:-300}
		});
		this.theend = new DateTimePicker('#theend', {
			timePicker: true,
			timePickerFormat:24,
			format: 'd/m/Y à H:i',
			allowEmpty:true,
			minuteIncrement:15,
			positionOffset: {x:0,y:-300}
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
			App.toggleSidePane();
		});
	},
	onTaskEditClick(e){
		// CLICK SUR LE BOUTON EDIT
		for (var i=0; i < App.data.length; i++){
			if (App.data[i]['task_id'] == this.dataset.edit.split('ti')[1]){
				var task = App.data[i];
			}
		}
		sidePane.querySelector('#task_id').value = task.task_id;
		sidePane.querySelector('#title').value = task.task_title;
		sidePane.querySelector('#description').value = task.task_description;
		App.thestart.setDate(task.task_created_on*1000);
		App.theend.setDate(task.task_end*1000);
		App.toggleSidePane();
	},
	toggleSidePane(){
		sidePane.classList.toggle('hide');
		sideFoot.classList.toggle('hide');
		mainPane.classList.toggle('hide');
		mainFoot.classList.toggle('hide');
		document.querySelector('.add-button').classList.toggle('chosen');
	},
	onTaskDeleteClick(e){
		// CLICK SUR LE BOUTON DELETE
		e.preventDefault();
		var ajax = new XMLHttpRequest();
		ajax.open("POST", App.config.ajaxUrl, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var req = "action=delete&task_id="+this.dataset.delete.split('ti')[1];
		ajax.send(req);
		var task = this;
		ajax.onreadystatechange = function() {
		  	if (ajax.readyState == 4 && ajax.status == 200) {
				var data = JSON.parse(ajax.responseText);
				if (data.reaction == "success") {
					console.log("Deletion Suceeded");
					App.reload(data);
				}
			}
		}
	},
	onTaskCompleteClick(e){
		// CLICK SUR LE BOUTON DELETE
		e.preventDefault();
		var ajax = new XMLHttpRequest();
		ajax.open("POST", App.config.ajaxUrl, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var req = "action=complete&task_id="+this.dataset.complete.split('ti')[1];
		ajax.send(req);
		var task = this;
		ajax.onreadystatechange = function() {
		  	if (ajax.readyState == 4 && ajax.status == 200) {
				var data = JSON.parse(ajax.responseText);
				if (data.reaction == "success") {
					console.log("Task Completed");
					App.reload(data);
				}
			}
		}
	},
	reload(data){
		console.log(data);
		App.record(data);
		App.clearTasks();
		App.renderTasks();
	},
	clearTasks(){
		let uls = document.getElementsByClassName('task-list');
		for (var i = 0; i < uls.length; i++) {
			while (uls[i].firstChild) {
			    uls[i].removeChild(uls[i].firstChild);
			}
		}
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
			let start = Math.round(this.thestart.getDate('T')/1000);
			let deadline = Math.round(this.theend.getDate('T')/1000);
			let id = document.getElementById('task_id').value;
			let action = id ? 'update' : 'add';

			var ajax = new XMLHttpRequest();
			ajax.open("POST", this.config.ajaxUrl, true);
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var req = "action="+action+"&task_title="+title+"&task_description="+description+"&task_created_on="+ start +"&task_end="+ deadline;
			if (id) req += ("&task_id="+id)

			ajax.send(req);
			ajax.onreadystatechange = function() {
			  	if (ajax.readyState == 4 && ajax.status == 200) {
					var data = JSON.parse(ajax.responseText);
					if (data.reaction == "success") {
						App.reload(data);
					}
				}
			}
			App.toggleSidePane();
		});
	},
	start(){
		this.getTasks();
		this.startPageBehaviors();
		this.startDatePickers();
	}
}

App.start();
