<?php
session_start();
header("Content-Type:application/json");
$json = array();
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
$query = "SELECT game_id, name, user_id, note, difficulty from game Order by difficulty asc, name asc";

if($result = $mysqli->query($query)){
	while($data = $result->fetch_array(MYSQLI_NUM)){
		$edit = false;
		if(isset($_SESSION["user"]) && isset($_SESSION["rank"]) && ($_SESSION["user"] == $data[2] || $_SESSION["rank"] <= 2)){
			$edit = true;
		}
		$json[] = array("id"=>$data[0],"game"=>$data[1],"user"=>USER::FindByID($data[2])["name"],"note"=>$data[3],"edit"=>$edit, "difficulty"=>$data[4] );
	}
}
echo json_encode($json);
?>