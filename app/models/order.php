<?php
require_once './employee.php';
    class Order{
        var $OrderID, $name, $title, $wage;

        function Order($SIN, $name, $title, $wage){
            $this->$SIN = $SIN;
            $this->$name = $name;
            $this->$title = $title;
            $this->$wage = $wage;
        }

        public static function getEmployee($SIN){
            // Get project from db
        }
    }
?>