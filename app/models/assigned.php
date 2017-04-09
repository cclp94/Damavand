<?php

require_once './connection.php';

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
        return Assigned::fromRow(query($sin)->fecth_assoc());
    }

    public static function fromRow($row) {
        $taskId      = $row['taskId'];
        $employeeSin = $row['employeeSin'];
        $hours       = $row['hours'];
        $wage        = $row['wage'];
        
        return new Assigned($taskId, $employeeSin, $hours, $wage);
    }

    function value() {
        return $hours * $wage;
    }
}

?>
