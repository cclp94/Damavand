<?php
require_once 'connection.php';

// Data collection
date_default_timezone_set("America/Montreal");
$startDate = DateTime::createFromFormat('Y-m-d', $project->startDate);
$deadline = DateTime::createFromFormat('Y-m-d', $project->deadline);
$endDate = DateTime::createFromFormat('Y-m-d', $project->endDate);
$currentDate = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
$earliest = ($endDate != NULL && $endDate->format('Y-m-d') < $currentDate->format('Y-m-d')) ? $endDate : $currentDate;
$actualTimeElapsed = $earliest->diff($startDate)->days;
$estimatedTimeElapsed = $project->estimatedTimeOfCompleteTasks();
$timeRatio = safeDivide($estimatedTimeElapsed, $actualTimeElapsed);
$phase = $project->latestPhase();
$actualTimeRemaining = $project->complete() ? 0 : $deadline->diff($currentDate)->days;
$estimatedTimeRemaining = $project->estimatedTimeRemaining();
$estimatedCost = $project->estimatedCostOfCompleteTasks();
$actualCost = $project->actualCostOfCompleteTasks();
$costRatio = safeDivide($estimatedCost, $actualCost);
$completeTasks = $project->completeTasks();
$completeTaskCount = count($completeTasks);
$taskCount = count($tasks);
?>

<table class="table" style="width:100%"
    <tr>
        <td colspan="3" align="center"> <h1> <?php echo $project->name ?> </h1> </td>
    </tr>
    <tr>
        <td colspan="3" align="center"> <?php echo $project->complete() ? "Complete" : "In Progress"; ?> </td>
    </tr>>
<tr>
<td>
<table class="table" style="width:100%">
    <tr>
        <td> Start Date </td>
        <td colspan="2"> <?php echo $startDate->format('Y-m-d') ?> </td>
    </tr>

<?php
if ($project->complete()) {
?>

    <tr>
        <td> End Date </td>
        <td colspan="2"> <?php echo $endDate->format('Y-m-d'); ?> </td>
    </tr>

<?php
} else {
?>

    <tr>
        <td> Deadline </td>
        <td colspan="2"> <?php echo $deadline->format('Y-m-d'); ?> </td>
    </tr>

<?php
}
?>

    <tr>
        <td>Phase</td>
        <td colspan="2"> <?php echo $phase ?> </td>
    </tr>
    <tr>
        <td>Tasks Complete</td>
        <td> <?php echo $completeTaskCount ?> / <?php echo $taskCount ?> </td>
        <td> <?php echo percentString(safeDivide($completeTaskCount, $taskCount)) ?> </td>
    </tr>
    <tr>
        <td>Actual Time Elapsed</td>
        <td colspan="2"> <?php echo $actualTimeElapsed . " day" . ($actualTimeElapsed == 1 ? "" : "s"); ?> </td>
    </tr>
    <tr>
        <td>Estimated Time Elapsed</td>
        <td colspan="2"> <?php echo $estimatedTimeElapsed . " day" . ($estimatedTimeElapsed == 1 ? "" : "s"); ?> </td>
    </tr>
    <tr>
        <td>Progress Ratio</td>
        <td> <?php echo percentString($timeRatio) ?> </td>
        <td> <?php echo progressColourString($timeRatio) ?> </td>
    </tr>

<?php
if (!$project->complete()) {
?>

    <tr>
        <td> Actual Days Remaining </td>
        <td colspan="2"> <?php echo $actualTimeRemaining ?> </td>
    </tr>
    <tr>
        <td> Estimated Days to Completion </td>
        <td colspan="2"> <?php echo $estimatedTimeRemaining ?> </td>
    </tr>

<?php
}
?>

</table>
</td>
<td>
<table class="table" style="width:100%">
    <tr>
        <td>Project Cost <br> (Estimated / Actual)</td>
        <td> <?php echo $estimatedCost ?> / <?php echo $actualCost ?> </td>
        <td> <?php echo percentString($costRatio) ?> </td>
        <td> <?php echo costColourString($costRatio) ?> </td>
    </tr>
</table>
</td>
</tr>
</table>

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
    return "<span style=\"color:$colour;\">$msg</span>";
}

function progressColourString($ratio) {
    $msg = progressMsg($ratio);
    $colour = progressColour($ratio);
    return "<span style=\"color:$colour;\">$msg</span>";
}

function percentString($x) {
    return round($x * 100).'%';
}

function safeDivide($x, $y) {
    return $y == 0 ? INF : $x / $y;
}

?>