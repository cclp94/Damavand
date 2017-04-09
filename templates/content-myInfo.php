<?php
require_once './app/models/client.php';
    // Get client
    $client = Client::getClientFromUser($user->userName);
    if(!isset($client)){
        echo '<script>console.log("client");</script>';
    }

    if(isset($_POST)){
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $name = $_POST['companyName'];
        $phoneNumber = $_POST['companyNumber'];
        
        $companyId = (isset($_POST['companyId']) ? $_POST['companyId'] : null);
        $companyCivic = $_POST['companyCivic'];
        $companyStreet = $_POST['companyStreet'];
        $companyCity = $_POST['companyCity'];
        $companyCountry = $_POST['companyCountry'];
        $companyProvince = $_POST['companyProvince'];
        $companyPostal = $_POST['companyPostal'];
        $address = new Address($companyId, $companyCivic, $companyStreet, $companyCity, $companyCountry, $companyProvince, $companyPostal);

        $contactName = $_POST['contactName'];
        $contactNumber = $_POST['contactNumber'];

        $contactId = (isset($_POST['contactId']) ? $_POST['contactId'] : null);
        $contactCivic = $_POST['contactCivic'];
        $contactStreet = $_POST['contactStreet'];
        $contactCity = $_POST['contactCity'];
        $contactCountry = $_POST['contactCountry'];
        $contactProvince = $_POST['contactProvince'];
        $contactPostal = $_POST['contactPostal'];
        $contactAddress = new Address($contactId, $contactCivic, $contactStreet, $contactCity, $contactCountry, $contactProvince, $contactPostal);

        $username = $client->userName;
        
        $newClient= new Client($id, $name, $address, $phoneNumber, $contactNumber, $contactName, $contactAddress, $username);
        
        if($_POST['update']){
            $newClient->update($client);
            if(isset($_POST['password']) && $_POST['password']){
                $password = $_POST['password'];
                User::updatePassword($username, $password);
            }
            $client = Client::getClientFromUser($user->userName);
        }
    }
?>

<form method="post" action="./info.php">
    <input type="hidden" name="id" value="<?php echo $client->id;?>">
    <div class="form-group">
        <label for="companyName" class="col-sm-2 control-label text-center">Company Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="companyName" placeholder="My Company" value="<?php echo $client->name?>" required/></br>
        </div>
    </div>
    <div class="form-group">
        <label for="companyNumber" class="col-sm-2 control-label text-center">Company Phone</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="companyNumber" placeholder="(514) 555-5555" value="<?php echo $client->phoneNumber;?>" required/></br>
        </div>
    </div>
    <label class="col-sm-12 control-label">Business Address</label><br/>
    <input type="hidden" name="companyId"  value="<?php echo $client->address->id;?>"/>
    <div class="form-group row">
            <div class="col-md-2 col-md-push-1">
                <input class="form-control" type="number" name="companyCivic" placeholder="1234" value="<?php echo $client->address->civic;?>" required/></br>
            </div>
            <div class="col-md-6 col-md-push-1">
                <input class="form-control" type="text" name="companyStreet" placeholder="Street Name" value="<?php echo $client->address->street;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="companyCity" placeholder="City" value="<?php echo $client->address->city;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="companyCountry" placeholder="Country" value="<?php echo $client->address->country;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="companyProvince" placeholder="Province" value="<?php echo $client->address->province;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="companyPostal" placeholder="Postal Code" value="<?php echo $client->address->postal;?>" required/></br>
            </div>
    </div>
    <div class="form-group">
            <label for="contactName" class="col-sm-2 control-label text-center">Contact Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="contactName" placeholder="Joe Doe" value="<?php echo $client->contactName;?>" required/></br>
            </div>
    </div>
    <div class="form-group">
            <label for="contactNumber" class="col-sm-2 control-label text-center">Contact Number</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="contactNumber" placeholder="(514) 555-555" value="<?php echo $client->contactNumber;?>" required/></br>
            </div>
    </div>
    <label class="col-sm-12 control-label">Contact Address</label><br/>
        <input type="hidden" name="contactId"  value="<?php echo $client->contactAddress->id;?>"/>

    <div class="form-group row">
            <div class="col-md-2 col-md-push-1">
                <input class="form-control" type="number" name="contactCivic" placeholder="1234" value="<?php echo $client->contactAddress->civic;?>" required/></br>
            </div>
            <div class="col-md-6 col-md-push-1">
                <input class="form-control" type="text" name="contactStreet" placeholder="Street Name" value="<?php echo $client->contactAddress->street;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="contactCity" placeholder="City" value="<?php echo $client->contactAddress->city;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="contactCountry" placeholder="Country" value="<?php echo $client->contactAddress->country;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="contactProvince" placeholder="Province" value="<?php echo $client->contactAddress->province;?>" required/></br>
            </div>
            <div class="col-md-3 col-md-push-1">
                <input class="form-control" type="text" name="contactPostal" placeholder="Postal Code" value="<?php echo $client->contactAddress->postal;?>" required/></br>
            </div>
    </div>
    <label class="col-sm-12 control-label">User Name</label><br/>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="username" placeholder="<?php echo $client->userName; ?>" value = "<?php echo $client->userName; ?>" disabled/><br/>
                    </div>
                </div>
        <label class="col-sm-12 control-label">Change Password</label><br/>
        <div class="form-group">
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password"/><br/>
            </div>
        </div>
    <input  class="btn btn-primary btn-lg center-block" type="submit" name="update" value="Update Client"/>
</form>