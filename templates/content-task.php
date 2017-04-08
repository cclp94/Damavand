<?php
    $id = null;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $task = Task::getTaskById($id);
    }
    if(isset($_POST['assign'])){
        $hours = $_POST['hours'];
        foreach($_POST['sins'] as $index => $sin){
            if(Employee::get($sin)->isAssignedToTask($task->id)){
                $task->updateEmployeeAssignment($sin, $hours[$index]);
            }
            $task->assignEmployee($sin, $hours[$index]);
        }
    }elseif(isset($_POST['deassign'])){
        foreach($_POST['sins'] as $sin){
            $task->deassignEmployee($sin);
        }
    }

    if(isset($_POST['edit'])){
        $projectId = $_POST['projectId'];
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $estimatedTime = $_POST['estimatedTime'];
        $estimatedCost = $_POST['estimatedCost'];
        $phase = $_POST['phase'];
        $description = $_POST['description'];
        (new Task($id, $name, $estimatedTime, $estimatedCost, $description, $startDate, $endDate, $projectId, null, $phase))->update();

    }
?>
<input type="hidden" id="taskId" value="<?php echo $task->id; ?>"/>
<ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li><a href="project-view.php?id=<?php echo $task->projectId;?>"><?php echo Project::getProject($task->projectId)->name;?></a></li>
  <li class="active"><?php echo $task->name ?></li>
</ol>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#task-list" aria-controls="task-list" role="tab" data-toggle="tab">Purchases</a>
            </li>
            <li role="presentation">
                <a href="#task-list" aria-controls="task-list" role="tab" data-toggle="tab">Permits</a>
            </li>
            <?php if($user->isAdmin()){?>
                <li role="presentation">
                    <a href="#assign-employee" aria-controls="assign-employee" role="tab" data-toggle="tab">Assign Employees</a>
                </li>
                <li role="presentation">
                    <a href="#task-edit" aria-controls="task-edit" role="tab" data-toggle="tab">Edit Task Info</a>
                </li>
            <?php }?>
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
                    showTaskPreviews();
                }elseif($user->isAdmin()){
                    echo '<a class="add-task" href="#">Add your first Purchase!</a>';
                }else{
                    echo '<strong>You don\'t have any Purchases yet</strong>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="task-edit">
            <form method="post" action="./task-view.php?id=<?php echo $task->id;?>">
                <input type="hidden" name="edit" />
                <input type="hidden" name = "projectId" value="<?php echo $task->projectId; ?>" />
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-center">Task Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="<?php echo $task->name; ?>" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label text-center">Start Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="startDate" value = "<?php echo $task->startDate;?>" placeholder=""/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="endDate" class="col-sm-2 control-label text-center">End Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" value="<?php echo $task->endDate; ?>" name="endDate"/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Estimated Time(days)</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="estimatedTime"  value="<?php echo $task->estTime; ?>" placeholder="365" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Estimated Cost</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="estimatedCost" value="<?php echo $task->estCost; ?>" placeholder="100,000" required/></br>
                    </div>
            </div>
            <!--
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Assigned Employees (Can select multiple)</label>
                    <div class="col-sm-10">
                        <select name = "supervisor[]" class="form-control" multiple>
                            <option value="none" selected>None</option>
                            <?php foreach(Employee::getAll() as $employee){ ?>
                                <option value = "<?php echo $employee->SIN; ?>"><?php echo $employee->name . " - " . $employee->title; ?> </option>
                            <?php } ?>
                        </select><br/>
                    </div>
            </div>
            -->
            <div class="form-group">
                    <label for="phase" class="col-sm-2 control-label text-center">Project Phase</label>
                    <div class="col-sm-10">
                        <input type="number" name="phase" value="<?php echo $task->phase; ?>" placeholder="1"/> <br/>
                    </div>
            </div>
            <div class="form-group">
                    <label for="description" class="col-sm-2 control-label text-center">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description"  rows="3"><?php echo $task->description; ?></textarea><br/>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add" value="Create"/>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="assign-employee">
           <table class="table table-striped" style="width:100%">
                <tr>
                    <th><input id="assignbox-master" type="checkbox"></th>
                    <th>SIN</th>
                    <th>Name</th>
                    <th>Hours</th>
                </tr>
            <?php foreach(Employee::getAll() as $employee){ 
                $hours = $employee->isAssignedToTask($id);
            ?>
                <tr class="<?php echo ($hours ? "success" : "danger"); ?>" default="<?php echo ($hours ? "success" : "danger"); ?>">
                    <td><input form="employee-assign-form" name="sins[]" value = "<?php echo $employee->SIN; ?>" class = "assignbox" type="checkbox"></td>
                    <td><?php echo $employee->SIN; ?></td>
                    <td class="col-md-4"><?php echo $employee->name; ?></td>
                    <td><input form="employee-assign-form" name="hours[]" type="number" value="<?php 
                        if($hours)
                            echo $hours;
                        else
                            echo "0";
                     ?>"></td>
                </tr>
            <?php } ?>
           </table>
           <div class="center-block col-md-12 text-center">
                <button form="employee-assign-form" id="assign" type="submit" name = "assign" class="btn btn-primary btn-lg">Assign</button>
                <button form="employee-assign-form" id= "desassign" type="submit" name="deassign" class="btn btn-default btn-lg">Desassign</button>
            </div>
            <form id="employee-assign-form" method="post" action="./task-view.php?id=<?php echo $task->id;?>">

            </form>
        </div>
    </div>
</div>

<?php

function showTaskPreviews(){
    foreach(Task::getAll() as $task){
        echo '<div class="project"><a href="./project-view.php?id='.$task->id.'" >';
        echo '<h1 class="project-title">'.$task->name.'</span></h1>';
        echo '<p class="project-creator">Project Phase: '.$task->phase;
        echo '</p>';
        echo '</a></div>';
    }
}

?>