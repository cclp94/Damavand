<?php
    $id = $_GET['id'];
    if (isset($id)) {
        $client = Client::getClient($id);
    } else {
        $clients = Client::getAll();
    }
    $newClient = null;
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

        if(isset($_POST['newusername']))
            $username = $_POST['newusername'];
        else
            $username = $_POST['username'];
        $password = $_POST['password'];
        
        $newUser = new User($username, $password, 'client');
        
        $newClient= new Client($id, $name, $address, $phoneNumber, $contactNumber, $contactName, $contactAddress, $username);

        if ($_POST['add']) {
            if($username && $password)
                $newUser->put();
            $newClient->put();
        }elseif($_POST['update']){
            if(isset($_POST['newusername']) && $username && $password)
                $newUser->put();
            elseif($newClient->userName && $password){
                User::updatePassword($newClient->userName, $password);
            }
            $newClient->update($client);
        }
    }
    
?>

<?php
    if (isset($client)) {
?>

<form method="post" action="./clients.php">
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
                        <input class="form-control" type="text" name="<?php echo ($client->userName ? "" : "new") ?>username" placeholder="<?php echo $client->userName; ?>" value = "<?php echo $client->userName; ?>"<?php echo ($client->userName ? "readonly" : "") ?>/><br/>
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

<?php
    } else {
?>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#client-list" aria-controls="employee-list" role="tab" data-toggle="tab">Clients</a>
            </li>
            <li role="presentation">
                <a href="#client-add" aria-controls="employee-add" role="tab" data-toggle="tab">Add Client</a>
            </li>
        </ul>
        <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="client-list">
            <?php
                if (isset($clients)) {
                    displayClientTable();
                } else {
                    echo '<a class="add-client" href="#">Add your first client!</a>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="client-add">
            <form method="post" action="./clients.php">
                <div class="form-group">
                    <label for="companyName" class="col-sm-2 control-label text-center">Company Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="companyName" placeholder="My Company" required/></br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="companyNumber" class="col-sm-2 control-label text-center">Company Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="companyNumber" placeholder="(514) 555-5555" required/></br>
                    </div>
                </div>
                <label class="col-sm-12 control-label">Business Address</label><br/>
                <div class="form-group row">
                        <div class="col-md-2 col-md-push-1">
                            <input class="form-control" type="number" name="companyCivic" placeholder="1234" required/></br>
                        </div>
                        <div class="col-md-6 col-md-push-1">
                            <input class="form-control" type="text" name="companyStreet" placeholder="Street Name" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="companyCity" placeholder="City" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="companyCountry" placeholder="Country" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="companyProvince" placeholder="Province" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="companyPostal" placeholder="Postal Code" required/></br>
                        </div>
                </div>
                <div class="form-group">
                        <label for="contactName" class="col-sm-2 control-label text-center">Contact Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="contactName" placeholder="Joe Doe" required/></br>
                        </div>
                </div>
                <div class="form-group">
                        <label for="contactNumber" class="col-sm-2 control-label text-center">Contact Number</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="contactNumber" placeholder="(514) 555-555" required/></br>
                        </div>
                </div>
                <label class="col-sm-12 control-label">Contact Address</label><br/>
                <div class="form-group row">
                        <div class="col-md-2 col-md-push-1">
                            <input class="form-control" type="number" name="contactCivic" placeholder="1234" required/></br>
                        </div>
                        <div class="col-md-6 col-md-push-1">
                            <input class="form-control" type="text" name="contactStreet" placeholder="Street Name" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="contactCity" placeholder="City" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="contactCountry" placeholder="Country" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="contactProvince" placeholder="Province" required/></br>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <input class="form-control" type="text" name="contactPostal" placeholder="Postal Code" required/></br>
                        </div>
                </div>
                <h2>System Portal User</h2>
                <input type="checkbox" id="create-user"/> Create user for client.</br>
                <div class="form-group">
                <label class="col-sm-2 control-label">User Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="username" name="username" placeholder="User Name" disabled/><br/>
                    </div>
                </div>
                <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" id="userPass" name="password" placeholder="Password" disabled/><br/>
                    </div>
                </div>
                <input  class="btn btn-primary btn-lg center-block" name="add" type="submit" value="Save"/>
            </form>
        </div>
    </div>
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
    
</div>

<?php
    }
?>

<?php
function displayClientTable(){
    global $employees;
    ?><table class="table table-striped" style="width:100%">
       <tr>
           <th>Name</th>
           <th>Business Phone</th>
           <th>Business Address</th>
           <th>Contact Phone</th>
           <th>Contact Address</th>
           <th></th>
    </tr><?php
    foreach(Client::getAll() as $client){
        echo '<tr>';
            echo tableCell('<a href="clients.php?id='.$client->id.'">'.$client->name.'</a>');
            echo tableCell($client->phoneNumber);
            echo tableCell($client->address->toString());
            echo tableCell($client->phoneNumber);
            echo tableCell($client->contactAddress->toString());
            echo tableCell('<a href="#" ><i class="fa fa-times" aria-hidden="true"></i></a>');
        echo '</tr>';
    }
    echo '</table>';
}

function tableCell($content){
    return '<td>'.$content.'</td>';
}

?>