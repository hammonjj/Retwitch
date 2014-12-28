<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ReTwitch</title>
    <style type="text/css">
        label {
            position: relative;
            vertical-align: middle;
            bottom: 1px;
        }
        input[type=text],
        input[type=password],
        input[type=submit],
        input[type=email] {
            display: block;
            margin-bottom: 15px;
        }
        input[type=checkbox] {
            margin-bottom: 15px;
        }
    </style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
//    if ($login->messages) {
//        foreach ($login->messages as $message) {
//            echo $message;
//        }
//    }
}
?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
