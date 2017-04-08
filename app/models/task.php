<?php
    require_once 'employee.php';
    class Task{
        var $id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase;

        function Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase){
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
        }

        public static function getAll(){
            $conn = connect();
            $sql = "Select * from Task order by phase;";
            $result = $conn->query($sql);
            $tasks = [];
            while ($result && $row = $result->fetch_assoc()) {
                $tasks[] = Task::fromRow($row);
            }
            return $tasks;
        }

        public static function fromRow($row){
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
            return new Task($id, $name, $estTime, $estCost, $description, $startDate, $endDate, $projectId, $employees, $phase);
        }

        public static function getEmployeesForTask($id){
            $conn = connect();
            $sql = "Select * from Assigned where taskId = ".$id.";";
            $result = $conn->query($sql);
            $employees = [];
            while ($result && $row = $result->fetch_assoc()) {
                $employees[] = Employee::get($row['employeeSin']);
            }
            return $employees;
        }

        public static function getTaskById($id){
            $conn = connect();
            $sql = "Select * from Task WHERE taskId = ".$id.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return Task::fromRow($row);
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Task(name, startDate, endDate, estimatedTime, estimatedCost, description, projectId, phase) " .
                   "VALUE('$this->name', '$this->startDate', '$this->endDate', $this->estTime, $this->estCost, '$this->description', " .
                   "$this->projectId, $this->phase);";
            if ($conn->query($sql) == TRUE) {
                echo "New Task created!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }
        }

        function update(){
            $conn = connect();
            $sql = "UPDATE Task"
                ." SET name = '".$this->name. 
                "', startDate = ".($this->startDate ? "'".$this->startDate."'" : "NULL"). 
                ", endDate = ".($this->endDate ? "'".$this->endDate."'": "NULL").
                ", estimatedTime = ".$this->estTime.
                ", estimatedCost = ".$this->estCost.
                ", description =  '".$this->description.
                "', phase = ".$this->phase." WHERE taskId = ".$this->id.";";
            if ($conn->query($sql) == TRUE) {
                echo "Task updated!";
            } else {
                echo "Error " . $sql . ": ". $conn->error;
            }

        }

        function assignEmployee($SIN, $hours){
            $conn = connect();
            $sql = "INSERT INTO Assigned VALUE(".$this->id.", ".$SIN.", ".$hours.");";
            $conn->query($sql);
        }

        function updateEmployeeAssignment($SIN, $hours){
            $conn = connect();
            $sql = "UPDATE Assigned SET hours = $hours WHERE taskId = $this->id AND employeeSin = $SIN;";
            $conn->query($sql);
        }

        function deassignEmployee($SIN){
            $conn = connect();
            $sql = "DELETE FROM Assigned WHERE taskId = ".$this->id." AND employeeSin = ".$SIN.";";
            $conn->query($sql);
        }
        
        function isComplete() {
            return $endDate != NULL;
        }

        static function completeCount() {
            $conn = connect();
            $sql = "SELECT COUNT(*) WHERE endDate IS NOT NULL;";
            //return $conn->query($sql)->fetch_assoc();
            return (int) $conn->query($sql);
        }
    }
?>