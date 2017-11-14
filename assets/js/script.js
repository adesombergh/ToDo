
datepickerDefault = new MtrDatepicker({
  target: "startedat"
});
datepickerDefault2 = new MtrDatepicker({
  target: "endedat"
});
let button = document.getElementById('plus');
button.addEventListener('click',handlePlusButton);

let sidePaneState = "closed";

let mainPane = document.getElementById('main-pane');
let sidePane = document.getElementById('side-pane');
let mainFoot = document.getElementById('main-foot');
let sideFoot = document.getElementById('side-foot');

let taskButtons = document.getElementsByClassName('task-name');
for (var i = 0; i < taskButtons.length; i++) {
	taskButtons[i].addEventListener('click',handleTaskButton);
}

function handleTaskButton(e){
	e.preventDefault();
	let detail = document.querySelector("#" + this.dataset.toggle + " .details");
	if (this.dataset.opened=="false") {
		removeClass(detail,'hide');
		this.dataset.opened = true;
	} else {
		addClass(detail,'hide');
		this.dataset.opened = false;
	}
}

function handlePlusButton(e){
	e.preventDefault();
	if ( sidePaneState == "closed"  ) {
		openSidePane();
		rotatePlus();
	} else {
		closeSidePane();
		unrotatePlus();
	}
}
function rotatePlus(){
	addClass(document.querySelector('.add-button'),'chosen');
}
function unrotatePlus(){
	removeClass(document.querySelector('.add-button'),'chosen');
}

function openSidePane(){
	addClass(mainPane, "hide");
	addClass(mainFoot, "hide");
	removeClass(sidePane, "hide");
	removeClass(sideFoot, "hide");
	sidePaneState = "opened";
}
function closeSidePane(){
	addClass(sidePane, "hide");
	addClass(sideFoot, "hide");
	removeClass(mainPane, "hide");
	removeClass(mainFoot, "hide");
	sidePaneState = "closed";
}

function addClass(element, classNameToAdd){
    element.className += ' ' + classNameToAdd;   
}

function removeClass(element, classNameToRemove){
    var elementClass = ' ' + element.className + ' ';
    while(elementClass.indexOf(' ' + classNameToRemove + ' ') !== -1){
         elementClass = elementClass.replace(' ' + classNameToRemove + ' ', '');
    }
    element.className = elementClass;
}