<?php
    // Get employees
    $employees = null;
?>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#employee-list" aria-controls="employee-list" role="tab" data-toggle="tab">Employees</a>
            </li>
            <li role="presentation">
                <a href="#employee-add" aria-controls="employee-add" role="tab" data-toggle="tab">Add Employee</a>
            </li>
        </ul>
    </div>
    <div class="col-md-3">
    <!-- Number of employees -->
        <div class="n-Employees">
            <span class="n-employeess-number"><?php echo count($employees); ?></span>
            <strong>Employee<?php if(count($employees) == 1)
                                     echo '';
                                  else
                                     echo 's'; ?>
             </strong>
        </div>
    <!-- total costs with projects -->
    </div>
    <!-- Tab panes -->
    <div class="tab-content col-md-9">
        <div role="tabpanel" class="tab-pane fade in active" id="employee-list">
            <?php
                if(isset($employees)){
                    showProjectPreviews();
                }else{
                    echo '<a class="add-employee" href="#">Add your first employee!</a>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="employee-add">
            <form method="post" action="./app/register.php">
                <div class="form-group">
                    <label for="employeeName" class="col-sm-2 control-label text-center">Employee Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="employeeName" placeholder="Employee Name" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="username" class="col-sm-2 control-label text-center">Username</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="username" placeholder="User" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="password" class="col-sm-2 control-label text-center">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" placeholder="Password" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="passwordConfirm" class="col-sm-2 control-label text-center">Confirm Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="passwordConfirm" placeholder="Confirm Password" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" placeholder="Email" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" value="Register"/>
            </form>
        </div>
    </div>
</div>

<?php

function showProjectPreviews(){
    foreach($projects as $project){
        echo '<div class="project"><a href="./project.php?id='.$project->id;
        echo '<h1 class="project-title">'.$project->title.'</h1>';
        echo '<span class="project-creator>'.$project->creator.'</span>';
        echo '</a></div>';
    }
}

?>