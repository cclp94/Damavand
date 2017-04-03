<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
    require_once 'address.php';
    class Client{
        var $id, $name, $address, $phoneNumber, $contactNumber, $contactName, $contactAddress, $userName;
        
        function Client($id, $name, $address, $phoneNumber, $contactNumber, $contactName, $contactAddress, $userName){
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->phoneNumber = $phoneNumber;
            $this->contactNumber = $contactNumber;
            $this->contactName = $contactName;
            $this->contactAddress = $contactAddress;
            $this->userName = $userName;
        }

        public static function getClient($id){
            // Get project from db
        }

        public static function fromRow($row){
            $clientId = $row["clientId"];
            $name = $row["name"];
            $businessPhoneNumber = $row["businessPhoneNumber"];

            $businessAId = $row["businessAId"];
            $businessCivic = $row["businessCivic"];
            $businessStreet = $row["businessStreet"];
            $businessCity = $row["businessCity"];
            $businessCountry = $row["businessCountry"];
            $businessPostal = $row["businessPostal"];
            $businessAddress = new Address($businessAId, $businessCivic, $businessStreet, $businessCity, $businessCountry, $businessPostal);

            $contactName = $row["contactName"];
            $contactPhoneNumber = $row["contactPhoneNumber"];

            $contactId = $row["contactId"];
            $contactCivic = $row["contactCivic"];
            $contactStreet = $row["contactStreet"];
            $contactCity = $row["contactCity"];
            $contactCountry = $row["contactCountry"];
            $contactPostal = $row["contactPostal"];
            $contactAddress = new Address($contactId, $contactCivic, $contactStreet, $contactCity, $contactCountry, $contactPostal);

            $userName = $row["userName"];

            return new Client($clientId, $name, $businessAddress, $businessPhoneNumber, $contactPhoneNumber, $contactName, $contactAddress, $userName);
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT clientId, name, businessPhoneNumber, Address1.addressId as businessAId,"
                  ." Address1.civicNumber as businessCivic, Address1.businessStreet,"
                  ." Address1.city as businessCity, Address1.country as businessCountry,"
                  ." Address1.postalCode as businessPostal,"
                  ."contactName, contactPhoneNumber, Address2.addressId as contactId,"
                  ." Address2.civicNumber as contactCivic, Address2.street as contactStreet,"
                  ." Address2.city as contactCity, Address2.country as contactCountry,"
                  ." Address2.postalCode as contactPostal, userName"
                  ."FROM Client, Address as Address1, Address as Address2"
                  ."WHERE Client.businessAddressId = Address1.addressId AND "
                  ."Client.contactAddressId = Address2.addressId ;";
            $result = $conn->query($sql);
            $clients = [];
            while ($result && $row = $result->fetch_assoc()) {
                $clients[] = Client::fromRow($row);
            }

            return $clients;
        }

        public static function getClientMock($id){
            // Get project from db
            return new Client($id, "Damavand", "5342 ave concordia", "514-555-5555", "Joe Doe", "5341 ave concordia");
        }

        function put(){
            $conn = connect();
            $sql = 'INSERT INTO Address(civicNumber, street, city, country, postalCode) VALUE('
                   . $this->address->civic . ', "'
                   . $this->address->street . '", "'
                   . $this->address->city . '", '
                   . $this->address->country . '", '
                   . $this->address->postalCode . ');';
            $conn->query($sql);
            $addressId = $conn->insert_id;
            $sql = 'INSERT INTO Address(civicNumber, street, city, country, postalCode) VALUE('
                   . $this->contactAddress->civic . ', "'
                   . $this->contactAddress->street . '", "'
                   . $this->contactAddress->city . '", '
                   . $this->contactAddress->country . '", '
                   . $this->contactAddress->postalCode . ');';
            $conn->query($sql);
            $contactAddressId = $conn->insert_id;
            $sql = "INSERT INTO Client(name, businessPhoneNumber, businessAddressId, contactName, contactPhoneNumber, contactAddressId) VALUE('"
                   . $this->name . "', '"
                   . $this->phoneNumber . "', '"
                   . $addressId . "', '"
                   . $this->contactName . "', '"
                   . $this->contactNumber . "', "
                   . $contactAddressId . ");";
            if ($conn->query($sql) == TRUE) {
                echo "New Client created!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }


    }


?>