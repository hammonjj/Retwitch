<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//GET
$response = file_get_contents("https://api.twitch.tv/kraken/videos/" . $_GET["vodid"]);
$json = json_decode($response);
$title = $json->title;
$length = $json->length;

$conn = new mysqli("mysql.retwitch.pingdynamic.com", "retwitch_root", "shadogi1", "retwitch_dev");

$result = $conn->query("SELECT VodName FROM _" . $_GET["userid"] . " WHERE P_VodId='" . $_GET["vodid"] . "'");

$records = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {$records = $records + 1;}

//New Record
if($records == 0)
{
    $conn->query("INSERT INTO _" . $_GET["userid"] . "(P_VodId, VodName, Stream, ReplayTime, Duration) VALUES ('" .
        $_GET["vodid"] . "', '" .
        $title . "', '" .
        "unknown" . "', '" .
        $_GET["currentTime"] . "', '" .
        $length . "')" );
}
//Update Current Record
else
{
    $conn->query("UPDATE _" . $_GET["userid"] . " SET ReplayTime=" .
        $_GET["currentTime"] . " WHERE P_VodId='" . $_GET["vodid"] . "'");
}

$conn->close();
?>