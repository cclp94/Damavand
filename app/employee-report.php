<?php

require_once 'connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/assigned.php';

?>

<table class="table" style="width:100%">
    <tr>
        <td align="center" colspan="2"> <h1> <?php echo $employee->name ?>  </h1> </td>
    </tr>
    <tr>
        <td align="center" colspan="2"> <h2> <?php echo $employee->title ?>  </h2> </td>
    </tr>
    <tr>
        <td>
            <table class="table" style="width:100%">
                <tr>
                    <td align="center"> Assigned Projects </td>
                </tr>
                <tr>
                    <td align="center"> <?php displayProjectTable($employee) ?> </td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table" style="width:100%">
                <tr>
                    <td align="center"> Total Hours </td>
                </tr>
                <tr>
                    <td align="center"> <?php echo $employee->totalHours(); ?> </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php

function displayProjectTable($employee) {
    ?>
    
    <table class="table table-striped" style="width:100%">
       <tr>
           <th> Project </th>
           <th> Assigned Tasks </th>
           <th> Total Hours </th>
        </tr>
    
    <?php

    foreach($employee->assignedProjects() as $project) {
        echo '<tr>';
        echo idLink($project, $project->name);
        echo tableCell(count($employee->assignedTasksInProject($project->projectId)));
        echo tableCell($employee->totalProjectHours($project->projectId));
        echo '</tr>';
    }
    echo '</table>';
}

function idLink($project, $content) {
    return tableCell("<a href='project-view.php?id=$project->projectId'>$content</a>");
}

?>
