var pullUp = document.getElementById('pull-up');
var hammer = new Hammer(pullUp);
hammer.get('pan').set({ direction: Hammer.DIRECTION_ALL });
var yPos = 0;
hammer.on("panup", function(e) { console.log('panup');
	console.log(e.deltaY)
	if(e.deltaY > (-85)){
		pullUp.style.height = e.deltaY*-1 + "px";
		yPos = e.deltaY*-1;
	}
});
hammer.on("pandown", function(e) { console.log('pandown');
		console.log(e.deltaY)
		if(e.deltaY > (-50)){
			pullUp.style.height = (85 - e.deltaY) + "px";;
		}
});
hammer.on("panend", function(e) { console.log('panend');
	if(e.deltaY > (-40)){
		yPos = 0;
		pullUp.style.height = 25 + "px";
	}else{
		pullUp.style.height = 85 + "px";
		yPos = 85;
	}
});
var sliders = document.getElementsByClassName('slider-fill');
[].slice.call(sliders).forEach(function(slider) {
	var hammertime = new Hammer(slider);
	var xPos = 0;
	var count = 0;
	var gelost = false;
	var gelost2 = false;
	hammertime.on('panleft', function(e) {
		if(gelost2 == false){
			e.target.style.width = e.deltaX + "px";
			xPos = e.deltaX;
			setScore(e.target.style.width);
		}else{
			e.target.style.width = (e.deltaX + xPos) +"px";
			setScore(e.target.style.width);
		}
	});
	hammertime.on('panright', function(e) {
		if(gelost == false){
			e.target.style.width = e.deltaX + "px";
			xPos = e.deltaX;
			setScore(e.target.style.width);
		}else{
			e.target.style.width = (e.deltaX + xPos) + "px";
			setScore(e.target.style.width);
		}
	});
	hammertime.on("panend", function(e) { console.log('panend');
		gelost = true;
		gelost2 = true;
		if(count > 0){
			xPos = e.deltaX + xPos;
		}
		count += 1;
	});
});
function setScore(score){ console.log("setScore");
	var score = parseInt(score.replace('px',''));
	score = Math.floor((score/260)*100);
	if(score > 100){
		score = 100;
	}
	console.log(score);
};