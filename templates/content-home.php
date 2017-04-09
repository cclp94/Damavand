<?php
    $projects = Project::getProjectsForUser($user);
    if(isset($_POST["add"])){
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $deadline = $_POST['deadline'];
        $budget = $_POST['budget'];
        $clientId = $_POST['client'];
        $supervisorId = $_POST['supervisor'];
        (new Project(null, $name, $supervisorId, $startDate, null, $deadline, $budget, $clientId))->put();
    }
?>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#project-list" aria-controls="project-list" role="tab" data-toggle="tab">Projects</a>
            </li>
            <?php if($user->isAdmin()){?>
                <li role="presentation">
                    <a href="#project-add" aria-controls="project-add" role="tab" data-toggle="tab">Add Project</a>
                </li>
            <?php }?>
        </ul>
        <!-- Tab panes -->
    <div class="tab-content col-md-12">
        <div role="tabpanel" class="tab-pane fade in active" id="project-list">
            <?php
                if(count($projects) > 0){
                    showProjectPreviews($user);
                }elseif($user->isAdmin()){
                    echo '<a class="add-project" href="#">Add your first project!</a>';
                }else{
                    echo '<strong>You don\'t have any projects yet</strong>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="project-add">
            <form method="post" action="./home.php">
                <div class="form-group">
                    <label for="projectName" class="col-sm-2 control-label text-center">Project Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" placeholder="Project Name" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label text-center">Start Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="startDate" placeholder="" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="passwordConfirm" class="col-sm-2 control-label text-center">Deadline</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="deadline" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Budget</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="budget" placeholder="100,000" required/></br>
                    </div>
            </div>

            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Supervisor</label>
                    <div class="col-sm-10">
                        <select name = "supervisor" class="form-control">
                            <option value="none" selected>None</option>
                            <?php foreach(Employee::getAll() as $employee){ ?>
                                <option value = "<?php echo $employee->SIN; ?>"><?php echo $employee->name . " - " . $employee->title; ?> </option>
                            <?php } ?>
                        </select><br/>
                    </div>
            </div>

            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Client</label>
                    <div class="col-sm-10">
                        <select name = "client" class="form-control">
                            <option value="none" selected>None</option>
                            <?php foreach(Client::getAll() as $client){ ?>
                                <option value = "<?php echo $client->id; ?>"><?php echo $client->name . " - " . $client->contactName; ?> </option>
                            <?php } ?>
                        </select><br/>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add" value="Create"/>
            </form>
        </div>
    </div>
    </div>
    <div class="col-md-3">
    <!-- Number of projects -->
        <div class="n-Projects">
            <span class="n-projects-number"><?php echo count($projects); ?></span>
            <strong>Project<?php if(count($projects) == 1)
                                     echo '';
                                  else
                                     echo 's'; ?>
             </strong>
        </div>
    <!-- total costs with projects -->
    </div>
    
</div>

<?php

function showProjectPreviews($user){
    foreach(Project::getProjectsForUser($user) as $project){
        echo '<div class="project"><a href="./project-view.php?id='.$project->projectId.'" >';
        echo '<h1 class="project-title">'.$project->name.'<span class="badge pull-right">'.$project->getNumberOfTasks().'</h1>';
        if($project->supervisor) echo '<span class="project-creator"><strong>Supervisor: </strong>'.$project->supervisor->name.' </span>';
        if($project->client) echo '<span class="project-creator"><strong>Client: </strong>'.$project->client->name.'</span>';
        echo '</a></div>';
    }
}

?>