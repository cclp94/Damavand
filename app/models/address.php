<?php
    class Address{
        var $id, $civic, $street, $city, $country, $province, $postal;
        
        function Address($id, $civicNumber, $street, $city, $country, $province, $postalCode) {
            $this->id = $id;
            $this->civic = $civicNumber;
            $this->street = $street;
            $this->city = $city;
            $this->country = $country;
            $this->province = $province;
            $this->postal = $postalCode;
        }

        public static function getAddress($id){
            // Get project from db
        }

        public static function getAddressMock($id){
            // Get project from db
            return new Address($id, 1234, "ave concordia", "Montreal", "Canada", "QC", "H3A 2K9");
        }

        function toString(){
            return "$this->civic $this->street, $this->city, $this->country, $this->province - $this->postal";
        }
    }


?>