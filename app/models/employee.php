<?php
    class Employee{
        var $SIN, $name, $title, $wage;

        function Employee($SIN, $name, $title, $wage){
            $this->SIN = $SIN;
            $this->name = $name;
            $this->title = $title;
            $this->wage = $wage;
        }

        public static function getAll() {
            // To be replaced with database call
            // foreach SIN
            //      list += get(SIN)
            //      return list
            $employees = [];
            for ($i = 0; $i < 10; ++$i){
                $employees[] = Employee::get(i);
            }
            return $employees;
        }

        public static function get($SIN) {
            return Employee::mock();
        }

        public static function mock() {
            return new Employee(123456789, "Bort", "Janitor", 15.00);
        }

        public static function getDB() {
            $servername = "rsc353_4.encs.concordia.ca";
            $username = "rsc353_4";
            $password = "aardvark";
            $db_name = "rsc353_4";

            $conn = mysqli_connect($servername, $username, $password, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully!";

            $sql = "SELECT *  FROM Employee";
            $result = $conn->query($sql);
            var_dump($result);
        }
    }
?>