<?php

// Was getting weird class redefinition errors - this fixed it
if (!class_exists("Assignment")) {

    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/connection.php';

    class Assignment {
        var $taskId, $employeeSin, $hours, $wage;
        
        function Assignment($taskId, $employeeSin, $hours, $wage) {
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
            return Assignment::fromRow(query($sin)->fetch_assoc());
        }

        public static function fromRow($row) {
            $taskId      = $row['taskId'];
            $employeeSin = $row['employeeSin'];
            $hours       = $row['hours'];
            $wage        = $row['wage'];

            return new Assignment($taskId, $employeeSin, $hours, $wage);
        }

        public static function getAllByTask($taskId) {
            $sql = "SELECT *
                    FROM Assigned
                    WHERE taskId = $taskId;";
            $result = query($sql);
            $assignments = [];
            while ($result && $row = $result->fetch_assoc()) {
                $assignments[] = Assignment::fromRow($row);
            }
            return $assignments;
        }

        function value() {
            return $this->hours * $this->wage;
        }
    }
}

?>
