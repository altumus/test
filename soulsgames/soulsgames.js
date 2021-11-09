let sekiro = ["sekiro.jpg", "sekiro1.jpeg", "sekiro2.jpg", "sekiro3.jpg"];
let eldenring = ["er.jpg", "er1.jpg", "er2.jpg", "er3.jpg"];
let i = 0;
let j = 0;


function trans(obj){

	if (obj.id == "er >" || obj.id == "er <" || obj.id == "s >" || obj.id == "s <"){
		document.getElementById('eldenring').classList.remove("appearing");
		document.getElementById('sekiro').classList.remove("appearing");
	};

	if (obj.id == "er >"){
		i++;
		if (i >= eldenring.length){
			i = 0;
		};
		setTimeout(() => document.getElementById('eldenring').classList.add("appearing"), 100);
		document.getElementById('eldenring').style.backgroundImage = "url(" + eldenring[i] + ")";
	}

	else if(obj.id == "er <"){
		i--;
		if(i < 0){
			i = eldenring.length - 1;
		};
		setTimeout(() => document.getElementById('eldenring').classList.add("appearing"), 100);
		document.getElementById('eldenring').style.backgroundImage = "url(" + eldenring[i] + ")";
	}

	if(obj.id == "s >"){
		j++;
		if (j >= sekiro.length){
			j = 0;
		};
		setTimeout(() => document.getElementById('sekiro').classList.add("appearing"), 100);
		document.getElementById('sekiro').style.backgroundImage = "url(" + sekiro[j] + ")";
	}

	else if(obj.id == "s <"){
		j--;
		if (j < 0){
			j = sekiro.length - 1;
		};
		setTimeout(() => document.getElementById('sekiro').classList.add("appearing"), 100);
		document.getElementById('sekiro').style.backgroundImage = "url(" + sekiro[j] + ")";
	};
};
