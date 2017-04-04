<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';

    class Employee{
        var $SIN, $name, $title, $wage;

        function Employee($SIN, $name, $title, $wage){
            $this->SIN = $SIN;
            $this->name = $name;
            $this->title = $title;
            $this->wage = $wage;
        }

        function put() {
            $conn = connect();
            $sql = "INSERT INTO Employee VALUE($this->SIN, '$this->name', '$this->title', $this->wage);";
            if ($conn->query($sql) == TRUE) {
                echo "New employee created!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }

        function update() {
            $conn = connect();
            $sql = "UPDATE Employee
                    SET name='$this->name',
                        title='$this->title',
                        wage=$this->wage 
                    WHERE sin=$this->SIN;";
            if ($conn->query($sql) == TRUE) {
                echo "Employee updated!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }

        public static function getAll() {
            if (!function_exists(mysqli_connect)) {
                return Employee::getAllMock();
            }

            $conn = connect();

            $sql = "SELECT * FROM Employee";
            $result = $conn->query($sql);
            $employees = [];
            while ($row = $result->fetch_assoc()) {
                $employees[] = Employee::fromRow($row);
            }

            return $employees;
        }

        public static function fromRow($row) {
            $SIN = $row["sin"];
            $name = $row["name"];
            $title = $row["title"];
            $wage = $row["wage"];

            return new Employee($SIN, $name, $title, $wage);
        }

        public static function getAllMock() {
            $employees = [];
            for ($i = 0; $i < 10; ++$i){
                $employees[] = Employee::get(i);
            }
            return $employees;
        }

        public static function get($SIN) {
            $conn = connect();
            $sql = "SELECT * FROM Employee WHERE SIN = $SIN;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return Employee::fromRow($row);
        }

        public static function mock() {
            return new Employee(123456789, "Bort", "Janitor", 15.00);
        }
    }
?>