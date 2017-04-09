<?php

// Was getting weird class redefinition errors - this fixed it
if (!class_exists("Assigned")) {

    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/connection.php';

    class Assigned {
        var $taskId, $employeeSin, $hours, $wage;
        
        function Assigned($taskId, $employeeSin, $hours, $wage) {
            $this->taskId = $taskId;
            $this->employeeSin = $employeeSin;
            $this->hours = $hours;
            $this->wage = $wage;
        }

        public static function get($taskId, $employeeSin) {
            $sql = "SELECT *
                    FROM Assigned
                    WHERE taskId = $taskID
                    AND employeeSin = $employeeSin;";
            return Assigned::fromRow(query($sin)->fetch_assoc());
        }

        public static function fromRow($row) {
            $taskId      = $row['taskId'];
            $employeeSin = $row['employeeSin'];
            $hours       = $row['hours'];
            $wage        = $row['wage'];

            return new Assigned($taskId, $employeeSin, $hours, $wage);
        }

        public static function getAllByTask($taskId) {
            $sql = "SELECT *
                    FROM Assigned
                    WHERE taskId = $taskID;";
            $result = query($sin);
            $assignments = [];
            while ($result && $row = $result->fetch_assoc()) {
                $assignments[] = Assigned::fromRow($row);
            }
            return $assignments;
        }

        function value() {
            return $hours * $wage;
        }
    }
}

?>
