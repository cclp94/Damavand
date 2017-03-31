<?php
    class Employee{
        var $SIN, $name, $title, $wage;

        function Employee($SIN, $name, $title, $wage){
            $this->SIN = $SIN;
            $this->name = $name;
            $this->title = $title;
            $this->wage = $wage;
        }

        public static function get($SIN){
            // Get project from db
        }

        public static function mock(){
            return new Employee(123456789, "Billy Bob", "Janitor", 15.00);
        }
    }
?>