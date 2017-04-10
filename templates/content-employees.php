<?php
    $SIN = $_GET['SIN'];
    if (isset($SIN)) {
        $employee = Employee::get($SIN);
    }
    $employees = Employee::getAll();
    $attribute = $_POST['attribute'];
    $value = $_POST['value'];
    if (isset($attribute) && isset($value)) {
        $employees = Employee::getBy($attribute, $value);
    }
    if ($_POST['add'] || $_POST['update'] || $_POST['delete']) {
        $SIN = $_POST['SIN'];
        $name = $_POST['name'];
        $title = $_POST['title'];
        
        $employee = new Employee($SIN, $name, $title);

        if ($_POST['add']) {
            $employee->put();
        } else if ($_POST['update']) {
            $employee->update();
        } else if ($_POST['delete']) {
            Employee::delete($SIN);
        }
    }
?>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#employee-list" aria-controls="employee-list" role="tab" data-toggle="tab">Employees</a>
            </li>
            
            <?php
            if (isset($SIN)) {
            ?>

            <li role="presentation">
                <a href="#employee-report" aria-controls="employee-report" role="tab" data-toggle="tab">Report</a>
            </li>
            
            <?php
            }
            ?>
            
            <li role="presentation">
                <a href="#employee-add" aria-controls="employee-add" role="tab" data-toggle="tab">Add Employee</a>
            </li>
        </ul>
        <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="employee-list">
            <?php
                if (isset($employee)) {
                    include 'edit-employee.php';
                } else {
                    include 'display-employees.php';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="employee-add">
            <form method="post" action="employees.php">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label text-center">Employee Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" placeholder="Employee Name" required/></br>
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
                <input class="btn btn-primary btn-lg center-block" type="submit" name = "add" value="Add Employee"/>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="employee-report">
            <?php include './app/employee-report.php'; ?>
        </div>
    </div>
    </div>
    <div class="col-md-3">
    <!-- Number of employees -->
        <div class="n-Projects summary-1 summary">
            <span class="summary-number"><?php echo count($employees); ?></span>
            <strong>Employee<?php if(count($employees) == 1)
                                     echo '';
                                  else
                                     echo 's'; ?>
             </strong>
        </div>
    </div>
    
</div>

<?php
function displayEmployeeTable(){
    global $employees;
    ?><table class="table table-striped" style="width:100%">
       <tr>
           <th>SIN</th>
           <th>Name</th>
           <th>Title</th>
    </tr><?php
    foreach($employees as $employee){
        echo '<tr>';
        echo sinLink($employee, $employee->SIN);
        echo sinLink($employee, $employee->name);
        echo sinLink($employee, $employee->title);
        echo '</tr>';
    }
    echo '</table>';
}

function sinLink($employee, $content) {
    return tableCell("<a href='employees.php?SIN=$employee->SIN'>$content</a>");
}

function tableCell($content){
    return '<td>'.$content.'</td>';
}

?>