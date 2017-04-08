<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
    class Permit{
        var $taskId, $type, $dateValidStart, $dateValidEnd, $cost;

        function Permit($taskId, $type, $dateValidStart, $dateValidEnd, $cost){
            $this->taskId = $taskId;
            $this->type = $type;
            $this->dateValidStart = $dateValidStart;
            $this->dateValidEnd = $dateValidEnd;
            $this->cost = $cost;
        }

        public static function fromRow($row){
            $taskId = $row['taskId'];
            $type = $row['type'];
            $dateValidStart = $row['dateValidStart'];
            $dateValidEnd = $row['dateValidEnd'];
            $cost = $row['cost'];
            return new Permit($taskId, $type, $dateValidStart, $dateValidEnd, $cost);
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT * FROM Permits;";
            $result = $conn->query($sql);
            $permits = [];
            while ($result && $row = $result->fetch_assoc()) {
                $permits[] = Permit::fromRow($row);
            }
            return $permits;
        }

        public static function getAllForTask($taskId){
            $conn = connect();
            $sql = "SELECT * FROM Permits WHERE taskId = $taskId;";
            $result = $conn->query($sql);
            $permits = [];
            while ($result && $row = $result->fetch_assoc()) {
                $permits[] = Permit::fromRow($row);
            }
            return $permits;
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Permits(taskId, type, dateValidStart, dateValidEnd, cost) "
            ."VALUE($this->taskId, '$this->type', '$this->dateValidStart', '$this->dateValidEnd', $this->cost);";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">New Permit created!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }
    }
?>