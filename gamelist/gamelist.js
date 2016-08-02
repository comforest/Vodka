var json;
document.write("<script src='/static/javascript/function.js'></script>");

$(document).ready(function(){
	$.ajax({
		url:'getGamelist.php',
		type:'post',
		success:function(data){
			json = data;
			writeList();
		},
		error: function (request, status, error) {
			console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

	$.each(["game","user","note"],function(key, value){
		$("#"+value).click(function(){
			json = sortJson(json, $(this).attr('id'));
			writeList();
		});
	});
});

function writeList(){
	var str = "";
	$.each(json,function(i,object){
	str += '<tr>';
	str += '<td>'+object["game"]+'</td>';
	str += '<td>'+object["user"]+'</td>';
	str += '<td>'+object["note"]+'</td>';
	str += '</tr>';
	});
	$("#list").html(str);
}

function showAddGame(){
    var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 200)/2);
	var option = "width=400, height=200,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("addGame","",option);
}
function showAddGameRank(){
	var left = Math.ceil((window.screen.width - 400)/2);
    var top = Math.ceil((window.screen.height - 450)/2);
	var option = "width=400, height=450,left="+left+",top="+top+", resizable=no, status=no,toolbar=no;";    //팝업창 옵션(optoin)
	window.open("addGame","",option);
}