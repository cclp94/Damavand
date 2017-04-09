<?php
    if(isset($_GET['id'])){
        $project = Project::getProject($_GET['id']);
    }
    $tasks = Task::getAll($project->projectId);
    if(isset($_POST["edit"])){
        $id = $_POST['projectId'];
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $deadline = $_POST['deadline'];
        $budget = $_POST['budget'];
        $clientId = $_POST['client'];
        $supervisorId = $_POST['supervisor'];
        (new Project($id, $name, $supervisorId, $startDate, null, $deadline, $budget, $clientId))->update();
    }elseif(isset($_POST["add"])){
        $projectId = $_POST['projectId'];
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $estimatedTime = $_POST['estimatedTime'];
        $estimatedCost = $_POST['estimatedCost'];
        $phase = $_POST['phase'];
        $description = $_POST['description'];
        (new Task($id, $name, $estimatedTime, $estimatedCost, $description, $startDate, $endDate, $projectId, null, $phase))->put();
    }
?>
<ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active"><?php echo $project->name ?></li>
</ol>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#task-list" aria-controls="task-list" role="tab" data-toggle="tab">Tasks</a>
            </li>
            <?php if($user->isAdmin()) { ?>
            <li role="presentation">
                <a href="#task-add" aria-controls="task-add" role="tab" data-toggle="tab">Create Task</a>
            </li>
            <li role="presentation">
                <a href="#project-edit" aria-controls="project-edit" role="tab" data-toggle="tab">Edit Project Info</a>
            </li>
            <?php } ?>
            <li role="presentation">
                <a href="#report" aria-controls="report" role="tab" data-toggle="tab">Report</a>
            </li>
        </ul>
    </div>
    <div class="col-md-3">
    <!-- Number of projects -->
        <div class="n-Projects">
            <span class="n-projects-number"><?php echo count($tasks); ?></span>
            <strong>Project<?php if(count($tasks) == 1)
                                     echo '';
                                  else
                                     echo 's'; ?>
             </strong>
        </div>
    <!-- total costs with projects -->
    </div>
    <!-- Tab panes -->
    <div class="tab-content col-md-9">
        <div role="tabpanel" class="tab-pane fade in active" id="task-list">
            <?php
                if(isset($tasks) && count($tasks) > 0){
                    showTaskPreviews($project->projectId);
                }elseif($user->isAdmin()){
                    echo '<a class="add-task" href="#">Add your first Task!</a>';
                }else{
                    echo '<strong>You don\'t have any projects yet</strong>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="task-add">
            <form method="post" action="./project-view.php?id=<?php echo $project->projectId;?>">
                <input type="hidden" name="add" />
                <input type="hidden" name = "projectId" value="<?php echo $project->projectId; ?>" />
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-center">Task Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" placeholder="Task Name" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label text-center">Start Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="startDate" placeholder=""/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="endDate" class="col-sm-2 control-label text-center">End Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="endDate"/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Estimated Time(days)</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="estimatedTime" placeholder="365" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Estimated Cost</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="estimatedCost" placeholder="100,000" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="phase" class="col-sm-2 control-label text-center">Project Phase</label>
                    <div class="col-sm-10">
                        <input type="number" name="phase" placeholder="1"/> <br/>
                    </div>
            </div>
            <div class="form-group">
                    <label for="description" class="col-sm-2 control-label text-center">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" rows="3"></textarea><br/>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add" value="Create"/>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="project-edit">
            <form method="post" action="./project-view.php?id=<?php echo $project->projectId;?>">
                <input type="hidden" name="edit" />
                <input type="hidden" name = "projectId" value="<?php echo $project->projectId; ?>" />
                <div class="form-group">
                    <label for="projectName" class="col-sm-2 control-label text-center">Project Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" placeholder="Project Name" value = "<?php echo $project->name; ?>" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label text-center">Start Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="startDate" placeholder="" value = "<?php echo $project->startDate; ?>" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="passwordConfirm" class="col-sm-2 control-label text-center">Deadline</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="deadline" value = "<?php echo $project->deadline; ?>" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Budget</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="budget" placeholder="100,000" value = "<?php echo $project->budget; ?>" required/></br>
                    </div>
            </div>

            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Supervisor</label>
                    <div class="col-sm-10">
                        <select name = "supervisor" class="form-control">
                            <option value="none" <?php echo (!isset($project->supervisor) ? 'selected' : '');?>>None</option>
                            <?php foreach(Employee::getAll() as $employee){ ?>
                                <option value = "<?php echo $employee->SIN; ?>" <?php echo ($project->supervisor->SIN == $employee->SIN ? 'selected' : ''); ?>><?php echo $employee->name . " - " . $employee->title; ?> </option>
                            <?php } ?>
                        </select><br/>
                    </div>
            </div>

            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Client</label>
                    <div class="col-sm-10">
                        <select name = "client" class="form-control">
                            <option value="none" <?php echo (!isset($project->client) ? 'selected' : '');?>>None</option>
                            <?php foreach(Client::getAll() as $client){ ?>
                                <option value = "<?php echo $client->id; ?>" <?php echo ($project->client->id == $client->id ? 'selected' : ''); ?>><?php echo $client->name . " - " . $client->contactName; ?> </option>
                            <?php } ?>
                        </select><br/>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add" value="Create"/>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane fade in" id="report">
            <?php include './app/report.php'; ?>
        </div>
    </div>
</div>

<?php

function showTaskPreviews($projectId){
    foreach(Task::getAll($projectId) as $task){
        echo '<div class="project"><a href="./task-view.php?id='.$task->id.'" >';
        echo '<h1 class="project-title">'.$task->name.'</span></h1>';
        echo '<p class="project-creator">Project Phase: '.$task->phase;
        echo '</p>';
        echo '</a></div>';
    }
}
?>