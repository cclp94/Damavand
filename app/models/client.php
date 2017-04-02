<?php
    class Client{
        var $id, $name, $address, $contactNumber, $contactName, $contactAddress;
        
        function Client($id, $name, $address, $contactNumber, $contactName, $contactAddress){
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->contactNumber = $contactNumber;
            $this->contactName = $contactName;
            $this->contactAddress = $contactAddress;
        }

        public static function getClient($id){
            // Get project from db
        }

        public static function getClientMock($id){
            // Get project from db
            return new Client($id, "Damavand", "5342 ave concordia", "514-555-5555", "Joe Doe", "5341 ave concordia");
        }
    }


?>