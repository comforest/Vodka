<?php
// User 정보 처리와 관련 된 Class 및 함수들
class User{
	/*	FindByID
	*	purpose : DB ID로 User 찾기
	*	reuturn : DB id가 $i인 User
	*/
	public static function FindByID($i){
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		$arr = array();
		if($result = $mysqli->query("SELECT * FROM user Where user_id = $i")){
			return $result->fetch_array(MYSQLI_ASSOC);
		}
		return null;
	}
	/*	FindByName
	*	purpose : 이름으로 User 찾기
	*	reuturn : 이름이 $str인 User array
	*/
	public static function FindByName($str){
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		$arr = array();
		if($result = $mysqli->query("SELECT * FROM user Where name =\"".$str."\"")){
			while($data = $result->fetch_array(MYSQLI_ASSOC)){
				$arr[] = $data;
			}
		}
		return $arr;
	}
	/*	FindByNickname
	*	purpose : 닉네임으로 User 찾기
	*	reuturn : 닉네임이 $str인 User array
	*/
	public static function FindByNickname($str){
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		$arr = array();
		if($result = $mysqli->query("SELECT * FROM user Where Nickname =\"".$str."\"")){
			if($data = $result->fetch_array(MYSQLI_ASSOC)){
				$arr = $data;
			}
		}
		return $arr;
	}
	/*	FindByName
	*	purpose : 학번으로 User 찾기
	*	reuturn : 학번이 $str인 User 정보 (mysqli_result 형식)
	*/
	public static function FindByStudentID($str){
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		if($result = $mysqli->query("SELECT * FROM user Where student_id =\"".$str."\"")){
			return $result->fetch_array(MYSQLI_ASSOC);
		}
		return null;
	}

	public static function GetAdmin(){
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		if($result = $mysqli->query("SELECT user_id,name,rank FROM user Where rank = 0")){
			return $result->fetch_array(MYSQLI_ASSOC);
		}
		return null;
	}


	/*	RankStrtoInt
	*	purpose : 숫자 => 보드카 등급
	*/
	public static function RankStrtoInt($s){
		switch ($s) {
			case "해":
				return 1;			
			case "달":
				return 2;
			case "별":
				return 3;
			case "구름":
				return 4;
		}
		return 5;
	}

	/*	RankInttoStr
	*	purpose : 보드카 등급 => 숫자
	*/
	public static function RankInttoStr($i){
		switch ($i) {
			case 1:
				return "해";			
			case 2:
				return "달";
			case 3:
				return "별";
			case 4:
				return "구름";
		}
		return "";	
	}

	/*	getShortStudentID
	*	purpose : 학번 앞 4자리 구하기
	*/
	public static function getShortStudentID($str){
		return substr($str,0,4);
	}


	/*	InttoOX
	*	purpose : boolean을 OX로 표현하기
	*/
	public static function InttoOX($i){
		if($i == 0){
			return "X";
		}else{
			return "O";
		}
	}
	/*	OXtoInt
	*	purpose : OX를 boolean으로 표현하기
	*/
	public static function OXtoInt($str){
		if($str == "O"){
			return 1;
		}else{
			return 0;
		}
	}


	/*	GenderStrtoInt
	*	purpose : 성별 String => Int
	*/
	public static function GenderStrtoInt($str){
		if($str=="남자"){
			return 1;
		}else if($str == "여자"){
			return 0;
		}
	}
	/*	GenderInttoStr
	*	purpose : 성별 Int => String
	*/
	public static function GenderInttoStr($i){
		if($i==1){
			return "남자";
		}else if($i == 0){
			return "여자";
		}
	}

	/*	AppendPhoneHypen
	*	purpose : 전화번호에 - 붙이기
	*/
	public static function AppendPhoneHypen($str){
		return 	substr($str,0,3)."-".substr($str,3,4)."-".substr($str, 7);
	}
	/*	RemovePhoneHypen
	*	purpose : 전화번호에 - 빼기
	*/
	public static function RemovePhoneHypen($str){
		return str_replace("-", "", $str);
	}

	/*	AppendPhoneHypen
	*	purpose :  기수 단위 붙이기
	*/
	public static function AppendClass($str){
		return $str."기";
	}
	/*	RemovePhoneHypen
	*	purpose : 기수 단위 제거
	*/
	public static function RemoveClass($str){
		return str_replace("기", "", $str);
	}

	public static function GetRecentClass(){
		require $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		if($result = $mysqli->query("SELECT class from user order by class desc")){
			if($data = $result->fetch_array(MYSQLI_ASSOC)){
				return $data["class"];
			}
		}
		return 0;
	}
}


?>