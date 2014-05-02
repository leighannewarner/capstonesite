var year;
var month;
var day;

$(document).ready(function() {
	year = $(".upnext-year").html();
	month = $(".upnext-month").html();
	day = $(".upnext-day").html();
});

function checkDay() {
	currentday = new Date();
	nextday = new Date(year, Number(month)-1, day, 0, 0, 0, 0);
	if(currentday.getFullYear() == nextday.getFullYear()) {
		if(currentday.getMonth() == nextday.getMonth()) {
			if(currentday.getDay() == nextday.getDay()) {
				return true;
			}
		}
	}
	
	return false;
}

function checkTime(start) {
	current = new Date();
	next = new Date(year, Number(month)-1, day, start, 0, 0, 0);

	if(checkDay()) {
		if(current.getHours() - next.getHours() == -1 && current.getMinutes() > 50) {
			return true;
		} else if (current.getHours() == next.getHours() && current.getMinutes() <= 50) {
			return true;
		}
	}
	
	return false;
}

function updateUpNext() {
	$( ".upnext-content" ).each(function (index) {
		var time = 0;
		var ampm = "";
		if ($( this ).find(".time").text()[1] != ':') {
			time = $( this ).find(".time").text()[0] + $( this ).find(".time").text()[1];
			ampm = $( this ).find(".time").text()[5];
		} else {
			time = ($( this ).find(".time").text()[0]);
			ampm = $( this ).find(".time").text()[4];
		}
	
		militarytime = 0;
		if (ampm == "p" && time != 12) {
			militarytime = Number(time) + 12;
		} else {
			militarytime = time;
		}
		
		if(checkTime(militarytime)) {
			$( ".upnext-content" ).css("display", "none");
			$( ".upnext-nothing" ).css("display", "none");
			$( ".upnext-nothingelse" ).css("display", "none");
			$( this ).css("display", "inline");
			return false;
		} else if(!checkDay()) {
			$( ".upnext-content" ).css("display", "none");
			$( ".upnext-nothingelse" ).css("display", "none");
			$( ".upnext-nothing" ).css("display", "inline");
			return false;
		} else {
			$( ".upnext-content" ).css("display", "none");
			$( ".upnext-nothing" ).css("display", "none");
			$( ".upnext-nothingelse" ).css("display", "inline");
		}
	});
}
		
window.setInterval("updateUpNext()", 10000);
window.onload=function(){ updateUpNext() };