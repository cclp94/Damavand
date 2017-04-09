<?php ?>

<form method="post" action="employees.php">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label text-center">Employee Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" value="<?php echo $employee->name ?>" required/></br>
        </div>
    </div>
    <div class="form-group">
            <label for="SIN" class="col-sm-2 control-label text-center">SIN</label>
            <div class="col-sm-10">
                <input class="form-control" type="number" min="0" max = "9999999999" name="SIN" value=<?php echo $employee->SIN ?> required/></br>
            </div>
    </div>
    <div class="form-group">
            <label for="title" class="col-sm-2 control-label text-center">Title</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="title" value="<?php echo $employee->title ?>" required/></br>
            </div>
    </div>
    <div class = "text-center">
        <input class="btn btn-primary btn-lg" type="submit" name="update" value="Update Employee"/>
        <input class="btn btn-primary btn-lg" type="submit" name="delete" value="Delete Employee"/>
        <a href="employees.php" class="btn btn-primary btn-lg" role="button">Back</a>
    </div>
</form>