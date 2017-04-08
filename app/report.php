<?php
require_once 'connection.php';

date_default_timezone_set("America/Montreal");
//$startDate = new DateTime($project->startDate);
$startDate = DateTime::createFromFormat('Y-m-d', $project->startDate);
var_dump($startDate);
//$currentDate = new DateTime(date("y-m-d"));
$currentDate = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
var_dump($currentDate);
$difference = $currentDate - $startDate;
echo $startDate->format("y-m-d") . "<br>";
echo $currentDate->format("y-m-d") . "<br>";
echo $difference . "<br>"   ;
$completeTaskCount = Task::completeCount();

$taskCount = count($tasks);
echo $project->name . "<br>";
echo "Tasks Complete: $completeTaskCount / $taskCount <br>";
?>

<?php

?>