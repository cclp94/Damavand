<?php
require_once 'connection.php';

date_default_timezone_set("America/Montreal");
$startDate = DateTime::createFromFormat('Y-m-d', $project->startDate);
$currentDate = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
$estimatedTime = Task::estimatedTimeOfComplete();
$actualTime = $currentDate->diff($startDate)->days;
$timeRatio = $estimatedTime / $actualTime;

$estimatedCost = Task::estimatedCostOfComplete();
$actualCost = Task::actualCostOfComplete();
$costRatio = $estimatedCost / ($actualCost + 0.0001);

echo $startDate->format("y-m-d") . "<br>";
echo $currentDate->format("y-m-d") . "<br>";
echo $actualTime . "<br>";
echo $estimatedTime . "<br>";

$completeTaskCount = Task::completeCount();
$completeTasks = Task::getAllComplete();

$taskCount = count($tasks);
echo $project->name . "<br>";
echo "Tasks Complete: $completeTaskCount / $taskCount <br>";
echo "Project Duration (Estimated / Actual): $estimatedTime / $actualTime (" . percentString($timeRatio) . ") " . progressColourString($timeRatio) . "<br>";
echo "Project Cost (Estimated / Actual): $estimatedCost / $actualCost (" . percentString($costRatio) . ") " . costColourString($costRatio) . "<br>";
?>

<?php

function progressMsg($ratio) {
    if ($ratio <= 0.0)
        return "No progress";
    if ($ratio <= 0.5)
        return "Way behind schedule";
    if ($ratio <= 0.9)
        return "Behind schedule";
    if ($ratio <= 1.1)
        return "On schedule";
    if ($ratio <= 1.5)
        return "Ahead of schedule";
    return "Way ahead of schedule";
}

function progressColour($ratio) {
    if ($ratio < 0.9)
        return "#ff0000";
    if ($ratio < 1.1)
        return "#0000cc";
    return "#00cc00";
}

function costMsg($ratio) {
    if ($ratio <= 0.5)
        return "Way below budget";
    if ($ratio <= 0.9)
        return "Below budget";
    if ($ratio <= 1.1)
        return "On budget";
    if ($ratio <= 1.5)
        return "Above budget";
    return "Way above budget";
}

function costColour($ratio) {
    if ($ratio < 0.9)
        return "#00cc00";
    if ($ratio < 1.1)
        return "#0000cc";
    return "#ff0000";
}

function costColourString($ratio) {
    $msg = costMsg($ratio);
    $colour = costColour($ratio);
    return "<div style=\"color:$colour;\">$msg</div>";
}

function progressColourString($ratio) {
    $msg = progressMsg($ratio);
    $colour = progressColour($ratio);
    return "<div style=\"color:$colour;\">$msg</div>";
}

function percentString($x) {
    return round($x * 100).'%';
}

?>