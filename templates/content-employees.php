<?php
    // Get employees
    $employees = [Employee::mockEmployee()];
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
                    echo 'Yay!';
                    showEmployeePreviews();
                }else{
                    echo '<a class="add-project" href="#">Add your first employee!</a>';
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
                    <label for="SIN" class="col-sm-2 control-label text-center">SIN</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" min="0" max = "9999999999" name="SIN" placeholder="0123456789" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="title" class="col-sm-2 control-label text-center">Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" placeholder="Title" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="wage" class="col-sm-2 control-label text-center">Wage</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="wage" placeholder="0.00" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" value="Add Employee"/>
            </form>
        </div>
    </div>
</div>

<?php

function showEmployeePreviews(){
    global $employees;
    foreach((array) $employees as $employee){
        //echo '<div class="employee-name"><a href="./employee.php?id='.$employee->name;
        //echo($employee->name);
        echo $employee->name;
        //echo '<span class="project-creator>'.$project->creator.'</span>';
        //echo '</a></div>';
    }
}

?>