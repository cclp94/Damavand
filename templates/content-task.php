<?php
    $id = null;
    $task = null;
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
    if(isset($_POST['add-purchase'])){
        $taskId = $id;
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $unitType = $_POST['unitType'];
        $purchaseDate = $_POST['purchaseDate'];
        $deliveryDate = $_POST['deliveryDate'];
        $supplierName = $_POST['supplierName'];
        $price = $_POST['price'];

        (new Purchase(null, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, null))->put();
    }
    if(isset($_POST['add-permit'])){
        $taskId = $id;
        $type = $_POST['type'];
        $dateValidStart = $_POST['dateValidStart'];
        $dateValidEnd = $_POST['dateValidEnd'];
        $cost = $_POST['cost'];

        (new Permit($taskId, $type, $dateValidStart, $dateValidEnd, $cost))->put();
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
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Purchases<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="purchases">
                    <li role="presentation" ><a href="#purchase-list" aria-controls="purchase-list" role="tab" data-toggle="tab">List Purchases</a></li>
                    <li role="presentation"><a href="#purchase-add" aria-controls="purchase-add" role="tab" data-toggle="tab">Add Purchase</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Permits<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="permits">
                    <li role="presentation"><a href="#permit-list" aria-controls="permit-list" role="tab" data-toggle="tab">List Permits</a></li>
                    <li role="presentation"><a href="#permit-add" aria-controls="permit-add" role="tab" data-toggle="tab">Add Permit</a></li>
                </ul>
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
    <!--======================List Purchases===============-->
    <div class="tab-content col-md-9">
        <div role="tabpanel" class="tab-pane fade in active" id="purchase-list">
            <?php
                if(count(Purchase::getAll()) > 0){
                    showPurchasePreviews();
                }elseif($user->isAdmin()){
                    echo '<a class="add-task" href="#">Add your first Purchase!</a>';
                }else{
                    echo '<strong>You don\'t have any Purchases yet</strong>';
                }
            ?>
        </div>
        <!--======================ADD PURCHASE===============-->
        <div role="tabpanel" class="tab-pane fade" id="purchase-add">
            <form method="post" action="./task-view.php?id=<?php echo $task->id;?>">
                <input type="hidden" name = "taskId" value="<?php echo $task->id; ?>" />
                <div class="form-group">
                    <label for="item" class="col-sm-2 control-label text-center">Item</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="item" placeholder="Item" required/></br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="col-sm-2 control-label text-center">Quantity</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="quantity" placeholder="1" required/></br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="unitType" class="col-sm-2 control-label text-center">Unit Type</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="unitType" placeholder="Unit Type" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="purchaseDate" class="col-sm-2 control-label text-center">Purchase Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="purchaseDate"  placeholder="" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="deliveryDate" class="col-sm-2 control-label text-center">Delivery Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="deliveryDate"/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="supplierName" class="col-sm-2 control-label text-center">Supplier Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="supplierName" placeholder="Supplier Name" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Price</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="price" placeholder="100,000" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add-purchase" value="Create"/>
            </form>
        </div>

        <!--======================List Permits===============-->
        <div role="tabpanel" class="tab-pane fade in" id="permit-list">
            <?php
                if(count(Permit::getAllForTask($task->id)) > 0){
                    showPermitPreviews($task->id);
                }elseif($user->isAdmin()){
                    echo '<a class="add-task" href="#">Add your first Permit!</a>';
                }else{
                    echo '<strong>You don\'t have any Permits yet</strong>';
                }
            ?>
        </div>
        <!--======================ADD PERMIT===============-->
        <div role="tabpanel" class="tab-pane fade" id="permit-add">
            <form method="post" action="./task-view.php?id=<?php echo $task->id;?>">
                <input type="hidden" name="add-permit" />
                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label text-center">Permit Type</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="type" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="dateValidStart" class="col-sm-2 control-label text-center">Start Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="dateValidStart" placeholder=""/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="dateValidEnd" class="col-sm-2 control-label text-center">Expiration Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="dateValidEnd"/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="cost" class="col-sm-2 control-label text-center">Cost</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="cost" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="add" value="Create"/>
            </form>
        </div>
        <!--======================EDIT TASK===============-->
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
        <!--======================ASSIGN EMPLOYEE===============-->
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

function showPurchasePreviews(){
    foreach(Purchase::getAll() as $purchase){
        echo '<div class="project"><a href="./purchase-view.php?id='.$purchase->id.'" >';
        echo '<span class="pull-right text-center"><strong>Amount Owed:</strong></br>'.$purchase->amountOwed.'</span>';
        echo '<h1 class="project-title">'.$purchase->item.' </span></h1>';
        echo '<span class="project-creator">Supplier: '.$purchase->supplierName.' </span>';
        echo '<span class="project-creator">Purchase Date: : '.$purchase->purchaseDate.' </span>';
        echo '</a></div>';
    }
}

function showPermitPreviews($id){
    echo $permit->type;
    echo '<table class="table table-striped" style="width:100%">'.
         '<tr>'.
         '    <th>Type</th>'.
         '    <th>Valid Start Date</th>'.
         '    <th>Expiration Date</th>'.
         '    <th>Cost</th>'.
         '</tr>';
    foreach(Permit::getAllForTask($id) as $permit){
        echo '<tr>
            <td>'.$permit->type.'</td>
            <td>'.$permit->dateValidStart.'</td>
            <td>'.$permit->dateValidEnd.'</td>
            <td>'.$permit->cost.'</td>
        </tr>';
    }
    echo '</table>';
}

?>