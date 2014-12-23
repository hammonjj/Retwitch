<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("mysql.retwitch.pingdynamic.com", "retwitch_root", "shadogi1", "retwitch_dev");
$result = $conn->query("SELECT P_VodId, VodName, Stream, ReplayTime, Duration FROM _" . $_GET["userid"]);

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"VodName":"'  . $rs["VodName"] . '",';
	$outp .= '"VodId":"'   . $rs["P_VodId"] . '",';
    $outp .= '"Stream":"'   . $rs["Stream"] . '",';
    $outp .= '"ReplayTime":"'. $rs["ReplayTime"] . '",';
    $outp .= '"Duration":"'. $rs["Duration"] . '"}';
}
$outp .="]";

$conn->close();
echo($outp);
?>