$(document).ready(function(){
	var date = new Date();
	var y = getParameter("y");
	var m = getParameter("m");
	if(y == null || m == null){
		y=date.getFullYear();
		m=date.getMonth();
	}
	WriteCalendar(y,m);

});
function WriteCalendar(y , m){
	$.ajax({
		url:'/calendar.php',
		type:'post',
		data:{year:y,month:(m+1)},
		success:function(data){
			HtmlCalendar(y ,m, data);
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}

	});	
}
function getParameter(param) {
	var returnValue;
	var url = location.href;
	var parameters = (url.slice(url.indexOf('?') + 1, url.length)).split('&');
	for (var i = 0; i < parameters.length; i++) {
		var varName = parameters[i].split('=')[0];
		if (varName.toUpperCase() == param.toUpperCase()) {
			returnValue = parameters[i].split('=')[1];
			return decodeURIComponent(returnValue);
		}
	}
	return null;
}

function HtmlCalendar(y, m, data){

	var firstDay = (new Date(y,m,1)).getDay();

	var last = [31,28,31,30,31,30,31,31,30,31,30,31];
	if (y%4 && y%100!=0 || y%400===0) {
	    lastDate = last[1] = 29;
	}

	var lastDate = last[m];


	function getCalendar(fy, fm){
		if(fm < 0){
			fm = 11;
			-- fy;
		}else if(fm > 11){
			fm = 0;
			++ fy;
		}
	    	return "WriteCalendar("+fy+"," + fm+ ")";
	}
	var not = 0;
	function getNotice(d){
		if(data == null) return "";
		var str = "";
		while(true){
			if(not >= data.length) break;
			var date = new Date(data[not]["date"]);
			if(date.getDate() == d){
				var s = "";
				if(data[not]["url"] != null){
					s = "href" + data[not]["url"];
				}
				str += "<a"+s+">"+data[not]["text"]+"</a>";
				++not;
			}else{
				break;
			}
		}
		return str;
	}

	var str = "<table>"
	+"<thead>"
	+"<tr>"
	+"<th colspan='7'>"
	+"<a onclick="+getCalendar(y-1,m)+">&laquo</a>"
	+"<a onclick="+getCalendar(y,m-1)+">&lt</a>"
	+y+"년 " + (m+1) + "월"
	+"<a onclick="+getCalendar(y,m+1)+">&gt</a>"
	+"<a onclick="+getCalendar(y+1,m)+">&raquo</a>"
	+"</th>"
	+"<tr>"
	+"<th>일</th>"
	+"<th>월</th>"
	+"<th>화</th>"
	+"<th>수</th>"
	+"<th>목</th>"
	+"<th>금</th>"
	+"<th>토</th>"
	+"</tr>"
	+"</thead>"
	+"<tbody>";

	var bool = true;
	var writeDate = 1;
	while(true){
		str += "<tr>";
		for(var i = 0; i < 7; ++i){
			if((writeDate > 1 && writeDate <= lastDate) || (writeDate == 1 && i == firstDay)){
				str += "<td>"
				+"<p>"+(writeDate)+"</p>"
				+ getNotice(writeDate);
				writeDate++;
				+"</td>";
			}else{
				str+="<td></td>";
			}
		}
		str +="</tr>"
		if(writeDate>lastDate){
			break;
		}
	}

	str += "</tbody>";

	$(".calendar").html(str);
}