<?php
    class Employee{
        var $SIN, $name, $title, $wage;

        function Employee($SIN, $name, $title, $wage){
            $this->SIN = $SIN;
            $this->name = $name;
            $this->title = $title;
            $this->wage = $wage;
        }

        public static function getEmployee($SIN){
            // Get project from db
        }

        public static function mockEmployee(){
            return new Employee(123456789, "Billy Bob", "Janitor", 15.00);
        }
    }
?>