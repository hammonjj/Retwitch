<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("mysql.retwitch.pingdynamic.com", "retwitch_root", "shadogi1", "retwitch_dev");
$result = $conn->query("SELECT P_VodId, VodName, Stream, ReplayTime, Duration, Recorded FROM _" . $_GET["userid"]);

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}

    $formattedDuration = sprintf( "%02d:%02d:%02d", $rs["Duration"] / 3600, $rs["Duration"] / 60 % 60, $rs["Duration"] % 60 );
    $formattedReplayTime = sprintf( "%02d:%02d:%02d", $rs["ReplayTime"] / 3600, $rs["ReplayTime"] / 60 % 60, $rs["ReplayTime"] % 60 );

    $outp .= '{"VodName":"'  . $rs["VodName"] . '",';
	$outp .= '"VodId":"'   . $rs["P_VodId"] . '",';
    $outp .= '"Stream":"'   . $rs["Stream"] . '",';
    $outp .= '"ReplayTime":"'. $rs["ReplayTime"] . '",';
    $outp .= '"Duration":"'. $rs["Duration"] . '",';
    $outp .= '"FormattedDuration":"'. $formattedDuration . '",';
    $outp .= '"FormattedReplayTime":"'. $formattedReplayTime . '",';
    $outp .= '"Recorded":"'. $rs["Recorded"] . '"}';
}
$outp .="]";

$conn->close();
echo($outp);
?>