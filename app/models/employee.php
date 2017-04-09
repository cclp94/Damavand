<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';

    class Employee{
        var $SIN, $name, $title;

        function Employee($SIN, $name, $title){
            $this->SIN = $SIN;
            $this->name = $name;
            $this->title = $title;
        }

        function put() {
            $conn = connect();
            $sql = "INSERT INTO Employee VALUE($this->SIN, '$this->name', '$this->title');";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">New employee created!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }

        function update() {
            $conn = connect();
            $sql = "UPDATE Employee
                    SET name='$this->name',
                        title='$this->title' 
                    WHERE sin=$this->SIN;";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">Employee updated!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }

        public static function delete($SIN) {
            $conn = connect();
            $sql = "DELETE FROM Employee
                    WHERE sin=$SIN;";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">Employee deleted!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
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

        public static function getBy($attribute, $value) {
            $conn = connect();

            $sql = "SELECT *
                    FROM Employee
                    WHERE $attribute='$value'";
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

            return new Employee($SIN, $name, $title);
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
            return new Employee(123456789, "Bort", "Janitor");
        }

        function isAssignedToTask($taskId){
            $conn = connect();
            $sql = "SELECT * FROM Assigned WHERE employeeSin = $this->SIN AND taskId = $taskId;";
            $result = $conn->query($sql);
            if($result && $row = $result->fetch_assoc()){
                return Assigned::fromRow($row);
            }
            return null;
        }
    }

    class Assigned{
        var $hours, $wage;

        function Assigned($hours, $wage){
            $this->hours = $hours;
            $this->wage = $wage;
        }

        public static function fromRow($row){
            $hours = $row['hours'];
            $wage = $row['wage'];

            return new Assigned($hours, $wage);
        }
    }
?>