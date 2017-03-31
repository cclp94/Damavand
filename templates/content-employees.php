<?php
    // Get employees - MOCK
    $employees = [];
    for ($i = 0; $i < 5; ++$i){
        $employees[] = Employee::mockEmployee();
    }
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
    </div>
    <!-- Tab panes -->
    <div class="tab-content col-md-9">
        <div role="tabpanel" class="tab-pane fade in active" id="employee-list">
            <?php
                if(isset($employees)){
                    displayEmployeeTable();
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

function displayEmployeeTable(){
    global $employees;
    echo
       '<table style="width:100%">
            <tr>
                <th>SIN</th>
                <th>Name</th>
                <th>Title</th>
                <th>Wage</th>
            </tr>';
    foreach($employees as $employee){
        echo '<tr>';
        echo tableCell('<a href="./employee.php?SIN='.$employee->SIN.'">'.$employee->SIN.'</a>');
        echo tableCell($employee->name);
        echo tableCell($employee->title);
        echo tableCell('$'.number_format($employee->wage, 2));
        echo '</tr>';
        //echo '<div class="employee"><a href="./employee.php?SIN='.$employee->SIN.'">';
        //echo span("employee-sin", $employee->SIN);
        //echo span("employee-name", $employee->name);
        //echo span("employee-title", $employee->title);
        //echo span("employee-wage", $employee->wage);
        
    }
    echo '</table>';
}

function tableCell($content){
    return '<td>'.$content.'</td>';
}

?>