<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel/IOFactory.php";
header( 'Content-type: application/vnd.ms-excel' ); 
header( 'Content-Disposition: inline; filename="listall_'.date('Ymd').'.xls"' );
header( 'Content-Description: sitePHPbasic Generated Data' );

echo "
    <table>
    <tr>
        <td>이름</td>
        <td>성별</td>
        <td>학번</td>
        <td>단과대</td>
        <td>전공</td>
        <td>전화번호</td>
        <td>활동지역</td>
        <td>기수</td>
        <td>등급</td>
        <td>비고</td>
    </tr>
    ";
include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
if($result = $mysqli->query("SELECT * FROM user order by rank asc,location DESC, name asc")){
    while($data = $result->fetch_array(MYSQLI_ASSOC)){
        echo "<tr>";
        echo "<td>".$data["name"]."</td>";
        echo "<td>".User::GenderInttoStr($data["gender"])."</td>";
        echo "<td>".$data["student_id"]."</td>";
        echo "<td>".$data["colleage"]."</td>";
        echo "<td>".$data["major"]."</td>";
        echo "<td>".User::AppendPhoneHypen($data["phone"])."</td>";
        echo "<td>".$data["location"]."</td>";
        echo "<td>".User::AppendClass($data["class"])."</td>";
        echo "<td>".User::RankInttoStr($data["rank"])."</td>";
        echo "<td>".$data["note"]."</td>";
        echo "</tr>";
    }
}


echo "</table>";

?>