<?php
    class Address{
        var $id, $civic, $street, $city, $country, $postalCode;
        
        function Address($id, $civicNumber, $street, $city, $country, $postalCode){
            $this->id = $id;
            $this->civicNumber = $civicNumber;
            $this->street = $street;
            $this->city = $city;
            $this->country = $country;
            $this->postalCode = $postalCode;
        }

        public static function getAddress($id){
            // Get project from db
        }

        public static function getAddressMock($id){
            // Get project from db
            return new Client($id, 1234, "ave concordia", "Montreal", "Canada", "H3A 2K9");
        }
    }


?>