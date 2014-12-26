<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//GET
$response = file_get_contents("https://api.twitch.tv/kraken/videos/" . $_GET["vodid"]);
$json = json_decode($response);
$vodTitle = $json->title;
$vodLength = $json->length;
$streamName = $json->channel->display_name;

$recordedAt = $json->recorded_at;
$truncRecordedAt = substr($recordedAt, 0, 10);
$datePieces = explode("-", $truncRecordedAt);
$formattedRecordedAt = $datePieces[1] . "-" . $datePieces[2] . "-" . $datePieces[0];

$conn = new mysqli("mysql.retwitch.pingdynamic.com", "retwitch_root", "shadogi1", "retwitch_dev");
$result = $conn->query("SELECT VodName FROM _" . $_GET["userid"] . " WHERE P_VodId='" . $_GET["vodid"] . "'");

$records = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {$records = $records + 1;}

if($records == 0)
{
    //Add New Record
    $conn->query("INSERT INTO _" . $_GET["userid"] . "(P_VodId, VodName, Stream, ReplayTime, Duration, Recorded) VALUES ('" .
        $_GET["vodid"] . "', '" .
        $vodTitle . "', '" .
        $streamName . "', '" .
        $_GET["currentTime"] . "', '" .
        $vodLength . "', '" .
        $formattedRecordedAt . "')" );
}
else
{
    //Update Existing Record
    $conn->query("UPDATE _" . $_GET["userid"] . " SET ReplayTime=" .
        $_GET["currentTime"] . " WHERE P_VodId='" . $_GET["vodid"] . "'");
}

$conn->close();
?>