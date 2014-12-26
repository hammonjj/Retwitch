<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("mysql.retwitch.pingdynamic.com", "retwitch_root", "shadogi1", "retwitch_dev");
$result = $conn->query("DELETE FROM _"  . $_GET["userid"] . " WHERE P_VodId='" . $_GET["vodid"] . "'");

?>