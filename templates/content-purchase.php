<?php
    $id = null;
    $task = null;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $purchase = Purchase::get($id);
        $task = Task::getTaskById($purchase->taskId);
        $project = Project::getProject($task->projectId);
    }

    if(isset($_POST['edit-purchase'])){
        $taskId = $id;
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $unitType = $_POST['unitType'];
        $purchaseDate = $_POST['purchaseDate'];
        $deliveryDate = $_POST['deliveryDate'];
        $supplierName = $_POST['supplierName'];
        $price = $_POST['price'];

        (new Purchase($id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, null))->update();
        $purchase = Purchase::get($id);
    }

    if(isset($_POST['pay'])){
        $date = $_POST['paymentDate'];
        $amount = $_POST['amount'];
        (new Payment(null, $purchase->id, $date, $amount))->put();
    }
?>

<ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li><a href="project-view.php?id=<?php echo $project->projectId;?>"><?php echo $project->name;?></a></li>
  <li><a href="task-view.php?id=<?php echo $task->id;?>"><?php echo $task->name;?></a></li>
  <li class="active"><?php echo $purchase->item ?></li>
</ol>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#info" aria-controls="task-list" role="tab" data-toggle="tab">Information</a>
            </li>
            <li role="presentation">
                <a href="#payments" aria-controls="task-list" role="tab" data-toggle="tab">Payments</a>
            </li>
            <li role="presentation">
                <a href="#make-payment" aria-controls="task-list" role="tab" data-toggle="tab">Make Payment</a>
            </li>
        </ul>
        <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="info">
            <form method="post" action="./purchase-view.php?id=<?php echo $purchase->id;?>">
                <input type="hidden" name = "taskId" value="<?php echo $task->id; ?>" />
                <div class="form-group">
                    <label for="item" class="col-sm-2 control-label text-center">Item</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="item" placeholder="Item" value="<?php echo $purchase->item; ?>" required/></br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="col-sm-2 control-label text-center">Quantity</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="quantity" placeholder="1" value="<?php echo $purchase->quantity; ?>" required/></br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="unitType" class="col-sm-2 control-label text-center">Unit Type</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="unitType" placeholder="Unit Type" value="<?php echo $purchase->unitType; ?>" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="purchaseDate" class="col-sm-2 control-label text-center">Purchase Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="purchaseDate"  placeholder="" value="<?php echo $purchase->purchaseDate; ?>" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="deliveryDate" class="col-sm-2 control-label text-center">Delivery Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="deliveryDate" value="<?php echo $purchase->deliveryDate; ?>" /></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="supplierName" class="col-sm-2 control-label text-center">Supplier Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="supplierName" placeholder="Supplier Name" value="<?php echo $purchase->supplierName; ?>" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Price</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="price" placeholder="100,000" value="<?php echo $purchase->price; ?>" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="edit-purchase" value="Edit"/>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="payments">
            <table class="table table-striped" style="width:100%">
                <tr>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
            <?php foreach(Payment::getAllForPurchase($purchase->id) as $payment){ ?>
                <tr>
                    <td><?php echo $payment->date; ?></td>
                    <td><?php echo $payment->amount; ?></td>
                </tr>
            <?php } ?>
           </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="make-payment">
            <form method="post" action="./purchase-view.php?id=<?php echo $purchase->id;?>">
                <div class="form-group">
                        <label for="paymentDate" class="col-sm-2 control-label text-center">Date</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="paymentDate" placeholder="" required/></br>
                        </div>
                </div>
                <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label text-center">Amount</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="amount" required/></br>
                        </div>
                </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" name="pay" value="Pay"/>
            </form>
        </div>
    </div>
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