<?php

require_once 'connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/assigned.php';

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
$finalPhase = $project->finalPhase();
$actualTimeRemaining = $project->complete() ? 0 : $deadline->diff($currentDate)->days;
$estimatedTimeRemaining = $project->estimatedTimeRemaining();
$estimatedCost = $project->estimatedCostOfCompleteTasks();
$actualCost = $project->actualCostOfCompleteTasks();
$costRatio = safeDivide($actualCost, $estimatedCost);
$completeTasks = $project->completeTasks();
$completeTaskCount = count($completeTasks);
$taskCount = count($tasks);
?>

<table class="table" style="width:100%">
    <tr>
        <td colspan = "2" align="center"> <h1> <?php echo $project->name ?> </h1> </td>
    </tr>
    <tr>
        <td colspan = "2" align="center"> <?php echo $project->complete() ? "Complete" : "In Progress"; ?> </td>
    </tr>
    <tr>
        <td align="center"> Client - <a href="clients.php?id=<?php echo $project->client->id ?>"> <?php echo $project->client->name ?> </a> </td>
        <td align="center"> Supervisor - <a href="employees.php?SIN=<?php echo $project->supervisor->SIN ?>"> <?php echo $project->supervisor->name ?> </a> </td>
    </tr>
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
                    <td colspan="2"> <?php echo $phase ?> / <?php echo $finalPhase ?> </td>
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
                    <td> Time Ratio </td>
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
                    <td> Budget </td>
                    <td colspan="2"> $<?php echo number_format($project->budget, 2); ?> </td>
                </tr>
                <tr>
                    <td> Actual Cost </td>
                    <td colspan="2">
                        <table class="table" style="width:100%">
                            <tr>
                                <td colspan="2"> $<?php echo number_format($actualCost, 2); ?> </td>
                            </tr>
                            <tr>
                                <td> Purchases </td>
                                <td> $<?php echo number_format($project->totalPurchases(), 2); ?> </td>
                            </tr>
                            <tr>
                                <td> Wages </td>
                                <td> $<?php echo number_format($project->totalWages(), 2); ?> </td>
                            </tr>
                            <tr>
                                <td> Permits </td>
                                <td> $<?php echo number_format($project->totalPermits(), 2); ?> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td> Estimated Cost </td>
                    <td colspan="2"> $<?php echo number_format($estimatedCost, 2); ?> </td>
                </tr>
                <tr>
                    <td> Cost Ratio </td>
                    <td> <?php echo percentString($costRatio) ?> </td>
                    <td> <?php echo costColourString($costRatio) ?> </td>
                </tr>
                <tr>
                    <td> Total Owed </td>
                    <td colspan="2"> $<?php echo number_format($project->totalOwed(), 2) ?> </td>
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
        return "#000066";
    return "#00cc00";
}

function costMsg($ratio) {
    if ($ratio <= 0.5)
        return "Way below estimates";
    if ($ratio <= 0.9)
        return "Below estimates";
    if ($ratio <= 1.1)
        return "On estimate";
    if ($ratio <= 1.5)
        return "Above estimates";
    return "Way above estimates";
}

function costColour($ratio) {
    if ($ratio < 0.9)
        return "#00cc00";
    if ($ratio < 1.1)
        return "#000066";
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