<?php ?>

<label for="search">Search by</label>
<form class="form-inline well" action="employees.php" method="post">
    <div class="form-group">
         <select name="attribute" class="form-control">
            <option value="sin" selected>SIN</option>
            <option value="name">Name</option>
            <option value="title">Title</option>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="value" class="form-control" placeholder="Search...">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Search</button>
    </div>
</form>

<?php

if (isset($employees)) {
    displayEmployeeTable();
} else {
    echo '<a class="add-employee" href="#">Add your first employee!</a>';
}

?>