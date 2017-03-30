<?php
require_once './app/models/client.php';
    // Get client
    $client = Client::getClientMock($user->userName);
    if(!isset($client)){
        echo '<script>console.log("client");</script>';
    }
?>

<form method="post" action="./app/register.php">
    <div class="form-group">
        <label for="Name" class="col-sm-2 control-label text-center">Company Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="projectName" value="<?php echo $client->name?>" required/></br>
        </div>
    </div>
<div class="form-group">
        <label for="address" class="col-sm-2 control-label text-center">Address</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address" value="<?php echo $client->address?>" required/></br>
        </div>
</div>
<div class="form-group">
        <label for="contactName" class="col-sm-2 control-label text-center">Contact Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="contactName" value="<?php echo $client->contactName?>" required/></br>
        </div>
</div>
<div class="form-group">
        <label for="contactNumber" class="col-sm-2 control-label text-center">Contact Number</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="contactNumber" value="<?php echo $client->contactNumber?>" required/></br>
        </div>
</div>
<div class="form-group">
        <label for="contactAddress" class="col-sm-2 control-label text-center">Contact Address<</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="contactAddress" value="<?php echo $client->contactAddress?>" required/></br>
        </div>
</div>
    <input  class="btn btn-primary btn-lg center-block" type="submit" value="Save"/>
</form>