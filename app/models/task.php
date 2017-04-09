<?php

require_once 'employee.php';
require_once 'purchase.php';
class Task{
    var $id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase, $actualCost;

    function Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase, $actualCost){
        $this->id = $id; 
        $this->name = $name; 
        $this->estTime = $estTime; 
        $this->estCost = $estCost; 
        $this->description =  $description;
        $this->startDate = $startDate; 
        $this->endDate = $endDate; 
        $this->projectId = $projectId; 
        $this->employees = $employees;
        $this->phase = $phase;
        $this->actualCost = $actualCost;
    }

    public static function getAll($projectId) {
        $sql = "SELECT *
                FROM Task
                WHERE projectID = $projectId
                ORDER BY phase;";
        $result = query($sql);
        $tasks = [];
        while ($result && $row = $result->fetch_assoc()) {
            $tasks[] = Task::fromRow($row);
        }
        return $tasks;
    }

    public static function fromRow($row) {
        $id = $row['taskId'];
        $name = $row['name']; 
        $estTime = $row['estimatedTime'];
        $estCost = $row['estimatedCost']; 
        $description =  $row['description'];
        $startDate = $row['startDate']; 
        $endDate = $row['endDate']; 
        $projectId = $row['projectId'];
        $employees = Task::getEmployeesForTask($id); 
        $phase = $row['phase'];
        $actualCost = $row['actualCost'];
        return new Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase, $actualCost);
    }

    public static function getEmployeesForTask($id) {
        $sql = "SELECT *
                FROM Assigned
                WHERE taskId = $id;";
        $result = query($sql);
        $employees = [];
        while ($result && $row = $result->fetch_assoc()) {
            $employees[] = Employee::get($row['employeeSin']);
        }
        return $employees;
    }

    public static function getTaskById($id) {
        $sql = "SELECT *
                FROM Task
                WHERE taskId = $id;";
        return Task::fromRow(query($sql)->fetch_assoc());
    }

    function put() {
        $startDate = $this->startDate ? "'$this->startDate'" : "NULL";
        $endDate = $this->endDate ? "'$this->endDate'" : "NULL";
        $sql = "INSERT INTO Task(name, startDate, endDate, estimatedTime, estimatedCost, description, projectId, phase)
                VALUE('$this->name', $startDate, $endDate, $this->estTime, $this->estCost, '$this->description', $this->projectId, $this->phase);";
        $result = query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">New Task created!</div>';
        }
    }

    function update() {
        $startDate = $this->startDate ? "'$this->startDate'" : "NULL";
        $endDate = $this->endDate ? "'$this->endDate'" : "NULL";
        $sql = "UPDATE Task
                SET name = '$this->name',
                    startDate = $startDate,
                    endDate = $endDate,
                    estimatedTime = $this->estTime,
                    estimatedCost = $this->estCost,
                    description =  '$this->description',
                    phase = $this->phase
                WHERE taskId = $this->id;";
        $result = query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">Task updated!</div>';
        }
    }

    function assignEmployee($SIN, $hours, $wage) {
        $sql = "INSERT INTO Assigned
                VALUE($this->id, $SIN, $hours, $wage);";
        query($sql);
    }

    function updateEmployeeAssignment($SIN, $hours, $wage) {
        $sql = "UPDATE Assigned
                SET hours = $hours,
                    wage = $wage
                WHERE taskId = $this->id
                AND employeeSin = $SIN;";
        query($sql);
    }

    function deassignEmployee($SIN) {
        $sql = "DELETE FROM Assigned
                WHERE taskId = $this->id
                AND employeeSin = $SIN;";
        query($sql);
    }
    
    function isComplete() {
        return $this->endDate != NULL;
    }

    function purchases() {
        return Purchase::getAll($this->id);
    }
}

?>