document.write("<script src='/static/javascript/sortTable.js'></script>");

$(document).ready(function(){
	addKeyList("difficulty","난이도");
	addKeyList("game","게임 이름");
	addKeyList("user","소유자");
	addKeyList("note","비고");

	getData("getGamelist.php");

});

// function writeList(){
// 	var str = "";
// 	$.each(json,function(i,object){
// 		str += '<tr>';
// 		str += '<td>'+object["difficulty"]+'</td>';
// 		str += '<td>'+object["game"]+'</td>';
// 		str += '<td>'+object["user"]+'</td>';
// 		str += '<td>'+object["note"]+'</td>';
// 		if(object["edit"] == true){
// 			var id = object["id"];
// 			str += "<td><a id='e"+id+"' class = 'edit'>O</a> <a id='d"+id+"' class = 'del'>X</a></td>";
// 		}
// 		str += '</tr>';
// 	});
// 	$("#list").html(str);
// 	$(".del").click(function(){
// 		var txt = $(this).parent().parent().children().first().html();
// 		if (confirm("정말로 "+txt+"를 삭제하시겠습니까?") == true) {
// 			var i = $(this).attr("id").substr(1);
// 			deleteGame(i);
// 		}
// 	});

// 	$(".edit").click(function(){

// 		var object = $(this).parent().parent().children().first();
// 		var game = object.next().html();
// 		var note = object.next().next().html();
// 		var diff = object.html();
		
// 	    var left = Math.ceil((window.screen.width - 400)/2);
// 	    var top = Math.ceil((window.screen.height - 200)/2);
// 		var option = "width=400, height=200,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";
// 		window.open("","dialog",option);

// 		var frm = document.dummy;
// 		frm.target = "dialog";
// 		frm.method = "post";
// 		frm.game.value = game;
// 		frm.diff.value = diff;
// 	    frm.note.value = note;
// 	    frm.id.value = $(this).attr("id").substr(1);
// 		frm.submit();

// 	});
// }

function showDialog(url,width,height){
    var left = Math.ceil((window.screen.width - width)/2);
    var top = Math.ceil((window.screen.height - height)/2);
	var option = "width="+width+", height="+height+",left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";
	window.open(url,"",option);
}

function deleteGame(id){
	$.ajax({
		url:"delete.php",
		type:"post",
		data:{"id":id},
		success:function(data){
			console.log(data);
			$("#d"+id).parent().parent().remove();
		}
	});
}